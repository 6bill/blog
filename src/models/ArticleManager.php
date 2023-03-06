<?php

namespace Blog\models;

use Blog\models\Article;
use Blog\models\UserManager;

/** Class ArticleManager **/
class ArticleManager
{
    private $connexion;

    public function __construct()
    {
        $this->connexion = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /** Enregistrement de l'article **/
    public function store()
    {
        if ($_SESSION["user"]["role"] == "admin") {
            $stmt = $this->connexion->prepare("INSERT INTO article(Titre, Date, Photo, Texte, Id_user, validation ) VALUES (:titre, NOW(), :photo, :texte, :idUser, 'oui')");
        } else {
            $stmt = $this->connexion->prepare("INSERT INTO article(Titre, Date, Photo, Texte, Id_user, validation ) VALUES (:titre, NOW(), :photo, :texte, :idUser, ?)");
        }
        $stmt->bindParam(':titre', $_POST["titre"], PDO::PARAM_STR);
        $stmt->bindParam(':photo', $_FILES["photo"]["name"], PDO::PARAM_STR);
        $stmt->bindParam(':texte', $_POST["texte"], PDO::PARAM_STR);
        $stmt->bindParam(':idUser', $_SESSION["user"]["id"], PDO::PARAM_INT);
        return  $stmt->execute();
    }
    /** Enregistrement d'un commentaire **/
    public function storeCommentaire($commentaire, $IdArticleCommente)
    {
        $titre = "Commentaire posté par " . $_SESSION["user"]["pseudo"];
        $stmt = $this->connexion->prepare("INSERT INTO article(Titre, Date, Texte, Id_user,IdArticleCommente ) VALUES (?, NOW(), ?, ?, ?)");
        $stmt->execute(array(
            $titre,
            $commentaire,
            $_SESSION["user"]["id"],
            $IdArticleCommente
        ));
        $lastId = $this->connexion->lastInsertId();
        return $this->getArticle($lastId);
    }
    /** Récupération de tous les articles **/
    /** Récupération de tous les articles **/
    public function getAll()
    {
        $stmt = $this->connexion->prepare('SELECT * FROM article WHERE IdArticleCommente IS NULL AND validation = ?');
        try {
            //ON MET L'INSTRUCTION DANS UN TRY
            $stmt->execute(array("oui"));
        } catch (\Exception $e) {
        //ON RECUPERE LES EVENTUELLES ERREURS SYSTEME
        //On stocke chaque détail de l'erreur dans des variables
        $FichierErreur = "Fichier erroné :" . $e->getFile();
        $numLigne = "<br><br>numéro ligne :" . $e->getLine();
        $messageErreur = "<br><br>code erreur et message :" . $e->getMessage();
        //On concatène les erreurs dans un string que l'on met en session
        $_SESSION["exception"] = $FichierErreur . $numLigne . $messageErreur;
        } finally {
            //IL FAUT TOUJOURS FERMER UNE CONNEXION
            $this->connexion = null;
            //ON RENVOIE L'ARRAY D'ARTICLES AU CONTROLLER
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Article");
        }
    }
    /** Récupération de tous les articles **/
    public function getNotify()
    {
        $stmt = $this->connexion->prepare('SELECT * FROM article WHERE IdArticleCommente IS NULL AND validation = ?');
        try {
            //ON MET L'INSTRUCTION DANS UN TRY
            $stmt->execute(array("non"));
        } catch (\Exception $e) {
            //ON RECUPERE LES EVENTUELLES ERREURS SYSTEME
            //On stocke chaque détail de l'erreur dans des variables
            $FichierErreur = "Fichier erroné :" . $e->getFile();
            $numLigne = "<br><br>numéro ligne :" . $e->getLine();
            $messageErreur = "<br><br>code erreur et message :" . $e->getMessage();
            //On concatène les erreurs dans un string que l'on met en session
            $_SESSION["exception"] = $FichierErreur . $numLigne . $messageErreur;
        } finally {
            //IL FAUT TOUJOURS FERMER UNE CONNEXION
            $this->connexion = null;
            //ON RENVOIE L'ARRAY D'ARTICLES AU CONTROLLER
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Article");
        }
    }
    /** Récupération de l'article à partir de son id**/
    public function getArticle($id)
    {
        $stmt = $this->connexion->prepare('SELECT * FROM article WHERE Id_article = ?');
        try {
            //ON MET L'INSTRUCTION DANS UN TRY
            $stmt->execute(array($id));
        } catch (\Exception $e) {
            //ON RECUPERE LES EVENTUELLES ERREURS SYSTEME
            //On stocke chaque détail de l'erreur dans des variables
            $FichierErreur = "Fichier erroné :" . $e->getFile();
            $numLigne = "<br><br>numéro ligne :" . $e->getLine();
            $messageErreur = "<br><br>code erreur et message :" . $e->getMessage();
            //On concatène les erreurs dans un string que l'on met en session
            $_SESSION["exception"] = $FichierErreur . $numLigne . $messageErreur;
        } finally {
            //IL FAUT TOUJOURS FERMER UNE CONNEXION
            $this->connexion = null;
            //ON RENVOIE L'ARRAY D'ARTICLES AU CONTROLLER
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Article");
        }
    }

    public function validate()
    {
        $stmt = $this->connexion->prepare("UPDATE article SET validation =? WHERE Id_article = ?");
        return $stmt->execute(array(
            "oui",
            $_POST['IdArticle']
        ));
    }

    /** Récupération des commentaires d'un article**/
    public function getArticleCommentaires($Id_article)
    {
        $stmt = $this->connexion->prepare('SELECT * FROM article WHERE IdArticleCommente = ?');
        $stmt->execute(array(
            $Id_article
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Commentaire");
    }

    /** Suppression d'un article **/
    public function delete($id)
    {
        $stmt = $this->connexion->prepare("DELETE FROM article WHERE Id_article = ?");
        $stmt->execute(array(
            $id
        ));
    }

    public function like()
    {
        //ON VA CHERCHER DANS LA BASE DE DONNEES SI LE COUPLE EXISTE DEJA
        $stmt = $this->connexion->prepare('SELECT * FROM `like` WHERE Id_article = ? AND Id_user=?');
        $stmt->execute(array(
            $_POST["Id_article"],
            $_SESSION['user']['id'],
        ));
        //on récupère le résultat dans un tableau
        $tabLikes = $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Like");

        //SI LE TABLEAU EST VIDE, cela veut dire que le couple n'existe pas
        //donc on va insérer
        if (count($tabLikes) == 0) {
            $stmt = $this->connexion->prepare("INSERT INTO `like` (Id_article, Id_user) VALUES(?, ?) ");
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
    public function unLike()
    {
        //ON VA CHERCHER DANS LA BASE DE DONNEES SI LE COUPLE EXISTE DEJA
        $stmt = $this->connexion->prepare('SELECT * FROM `like` WHERE Id_article = ? AND Id_user= ?');
        $stmt->execute(array(
            $_POST["Id_article"],
            $_SESSION['user']['id'],
        ));
        //on récupère le résultat dans un tableau
        $tabLikes = $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Like");
        //SI LE TABLEAU EST VIDE, cela veut dire que le couple n'existe pas
        //donc on va insérer
        if (count($tabLikes) == 0) {
            $stmt = $this->connexion->prepare("INSERT INTO `like` (Id_article, Id_user) VALUES(?, ?) ");
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
        $stmt = $this->connexion->prepare("UPDATE article SET Titre = ?, Photo = ?, Texte = ?, Id_user = ? Where Id_article = ? and IdArticleCommente is null");
        return $stmt->execute(array(
            $_POST["titre"],
            $_POST['photo'],
            $_POST["texte"],
            $_SESSION['user']['id'],
            $_POST["IdArticle"]
        ));
    }

    public function getArticleByWords()
    {
        $stmt = $this->connexion->prepare('SELECT * FROM article WHERE Titre LIKE ? and IdArticleCommente is null');
        $stmt->execute(array(
            "%" . $_POST['recherche'] . "%"
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Article");
    }

    /** Récupération des articles à partir d'un id user*/
    public function getArticlesByUser($idUser)
    {
        $stmt = $this->connexion->prepare('SELECT * FROM article WHERE Id_user = ?');
        $stmt->execute(array(
            $idUser
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\Article");
    }
}