<?php

namespace Blog\models;

use Blog\models\Article;
use Blog\models\UserManager;

/** Class ArticleManager **/
class ArticleManager
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /** Enregistrement de l'article **/
    public function store()
    {
        if ($_SESSION["user"]["role"] == "admin") {
            $stmt = $this->bdd->prepare("INSERT INTO article(Titre, Date, Photo, Texte, Id_user, validation) VALUES (?, NOW(), ?, ?, ?,'oui')");
        } else {
            $stmt = $this->bdd->prepare("INSERT INTO article(Titre, Date, Photo, Texte, Id_user, validation) VALUES (?, NOW(), ?, ?, ?, ?)");
        }
        $retour = $stmt->execute(array(
            $_POST["name"],
            $_FILES["photo"]["name"],
            $_POST["texte"],
            $_SESSION["user"]["id"]
        ));
        return $retour;
    }
    /** Enregistrement d'un commentaire **/
    public function storeCommentaire($commentaire, $IdArticleCommente)
    {
        $titre = "Commentaire posté par " . $_SESSION["user"]["pseudo"];
        $stmt = $this->bdd->prepare("INSERT INTO article(Titre, Date, Texte, Id_user,IdArticleCommente ) VALUES (?, NOW(), ?, ?, ?)");
        $stmt->execute(array(
            $titre,
            $commentaire,
            $_SESSION["user"]["id"],
            $IdArticleCommente
        ));
        $lastId = $this->bdd->lastInsertId();
        return $this->getArticle($lastId);
    }

    /** Récupération de tous les articles **/
    public function getAll()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM article WHERE IdArticleCommente IS NULL AND validation = ?');
        $stmt->execute(array(
            "oui"
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Article");
    }

    /** Récupération de tous les articles **/
    public function getNotify()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM article WHERE IdArticleCommente IS NULL AND validation = ?');
        $stmt->execute(array(
            "non"
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Article");
    }

    /** Récupération de l'article à partir de son id**/
    public function getArticle($id)
    {
        $stmt = $this->bdd->prepare('SELECT * FROM article WHERE Id_article = ?');
        $stmt->execute(array(
            $id
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Article");
    }

    public function validate()
    {

        $stmt = $this->bdd->prepare("UPDATE article SET validation =? WHERE Id_article = ?");
        $retour = $stmt->execute(array(
            "oui",
            $_POST['IdArticle']
        ));
        return $retour;
    }

    /** Récupération des commentaires d'un article**/
    public function getArticleCommentaires($Id_article)
    {
        $stmt = $this->bdd->prepare('SELECT * FROM article WHERE IdArticleCommente = ?');
        $stmt->execute(array(
            $Id_article
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Commentaire");
    }

    /** Suppression d'un article **/
    public function delete($id)
    {
        $stmt = $this->bdd->prepare("DELETE FROM article WHERE Id_article = ?");
        $stmt->execute(array(
            $id
        ));
    }

    public function like()
    {
        //ON VA CHERCHER DANS LA BASE DE DONNEES SI LE COUPLE EXISTE DEJA
        $stmt = $this->bdd->prepare('SELECT * FROM `like` WHERE Id_article = ? AND Id_user=?');
        $stmt->execute(array(
            $_POST["Id_article"],
            $_SESSION['user']['id'],
        ));
        //on récupère le résultat dans un tableau
        $tabLikes = $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Like");

        //SI LE TABLEAU EST VIDE, cela veut dire que le couple n'existe pas
        //donc on va insérer
        if (count($tabLikes) == 0) {
            $stmt = $this->bdd->prepare("INSERT INTO `like` (Id_article, Id_user) VALUES(?, ?) ");
            $stmt->execute(array(
                $_POST["Id_article"],
                $_SESSION['user']['id'],
            ));
            $_SESSION["like"]="Article aimé";
        }
        else{
            $_SESSION["erreur"]="vous aimez déjà cet article";
        }
    }

    public function update()
    {
        $stmt = $this->bdd->prepare("UPDATE article SET Titre = ?, Photo = ?, Texte = ?, Id_user = ? Where Id_article = ? and IdArticleCommente is null");
        $retour = $stmt->execute(array(
            $_POST["titre"],
            $_POST['photo'],
            $_POST["texte"],
            $_SESSION['user']['id'],
            $_POST["IdArticle"]
        ));
        return $retour;
    }

    public function getArticleByWords()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM article WHERE Titre LIKE ? and IdArticleCommente is null');
        $stmt->execute(array(
            "%" . $_POST['recherche'] . "%"
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Article");
    }


    /** Récupération des articles à partir d'un id user*/
    public function getArticlesByUser($idUser)
    {
        $stmt = $this->bdd->prepare('SELECT * FROM article WHERE Id_user = ?');
        $stmt->execute(array(
            $idUser
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Article");
    }
}