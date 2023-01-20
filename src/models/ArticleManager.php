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
        $stmt = $this->bdd->prepare("INSERT INTO article(Titre, Date, Photo, Texte, Id_user ) VALUES (?, NOW(), ?, ?, ?)");
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


    /** Récupération de tous les articles **/
    public function getAll()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM article WHERE IdArticleCommente IS NULL');
        $stmt->execute(array());
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


}
