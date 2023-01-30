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
        $stmt = $this->bdd->prepare("INSERT INTO article(Titre, Date, Photo, Texte, Id_user) VALUES (?, NOW(), ?, ?, ?)");
        $retour = $stmt->execute(array(
            $_POST["name"],
            $_FILES["photo"]["name"],
            $_POST["texte"],
            $_SESSION["user"]["id"]
        ));
        return $retour;
    }

    /** Enregistrement d'un commentaire **/
    public function storeCommentaire()
    {
//        $article = new Article();
//        $date = escape($article->getDate());
//        date_format($date, 'D d M Y');
        $titre = "Commentaire posté le par " . $_SESSION["user"]["pseudo"];
        $stmt = $this->bdd->prepare("INSERT INTO article(Titre, Date, Photo, Texte, Id_user,IdArticleCommente ) VALUES (?, NOW(), ?, ?, ?,?)");
        $retour = $stmt->execute(array(
            $titre,
            $_FILES["photo"]["name"],
            $_POST["texte"],
            $_SESSION["user"]["id"],
            $_POST["IdArticleCommente"]
        ));
        return $retour;
    }
    public function checkACT(){
        $stmt = $this->bdd->prepare('UPDATE article SET statue = 1 WHERE Id_article= ?');
        $stmt->execute(array(
            $_POST['IDARTICLE']
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS,"Blog\Models\Article");
    }

    /** Récupération de tous les articles **/
    public function getAll()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM article where statue = 1');
        $stmt->execute(array());
        return $stmt->fetchAll(\PDO::FETCH_CLASS,"Blog\Models\Article");
    }

    public function getOneArticle()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM article where statue = 1 AND Id_article = ?');
        $stmt->execute(array($_POST['IDARTICLE']));
        return $stmt->fetchAll(\PDO::FETCH_CLASS,"Blog\Models\Article");
    }

    public function getArticleByPseudo()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM `article` WHERE id_user = ?;');
        $stmt->execute(array($_POST['IDPSEUDO']));
        return $stmt->fetchAll(\PDO::FETCH_CLASS,"Blog\Models\Article");
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
        $stmt = $this->bdd->prepare("DELETE FROM article WHERE id_article = ?");
        $stmt->execute(array(
            $id
        ));
    }

    function updateArticle()
    {
        //ON UTILISE LA METHODE prepare() de PDO POUR FAIRE UNE REQUETE PARAMETREE
        $stmt = $this->bdd->prepare("UPDATE article SET Titre=?, Photo=?, Texte=? WHERE id_article=?");
        $stmt->execute(array(
            $_POST['Titre'],
            $_POST['image'],
            $_POST['Texte'],
            $_POST['IDARTICLE']
        ));
    }

    /** Récupération de l'article à partir de son id**/
    public function getStatue0()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM article WHERE statue = 0');
        $stmt->execute(array( ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS,"Blog\Models\Article");
    }

    /** Suppression de l'article **/
    public function check($id) {
        $stmt = $this->bdd->prepare("UPDATE article SET statue = '1' WHERE Id_article = ?");
        $stmt->execute(array( $id ));
    }

    public function getArticleByWords(){
        $stmt = $this->bdd->prepare("SELECT * FROM article WHERE Titre LIKE ? AND IdArticleCommente IS NULL ");
        $stmt->execute(array(
            '%' . $_POST["recherche"] .'%'
        ));

        return $stmt->fetchAll(\PDO::FETCH_CLASS,"Blog\Models\Article");

    }

}
