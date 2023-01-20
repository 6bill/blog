<?php

namespace Blog\controllers;

use Blog\models\ArticleManager;

/** Class ArticleController **/
class ArticleController
{
    private $manager;

    public function __construct()
    {
        $this->manager = new ArticleManager();
    }

    /** HomePage **/
    public function index()
    {
        require VIEWS . 'Article/homepage.php';
    }

    /** Formulaire de création d'article **/
    public function create()
    {
        if (isset($_SESSION["user"])) {

            require VIEWS . 'Article/create.php';
        }else{
            header("Location: /");
        }
    }

    /** Formulaire de modification d'article **/
    public function modification()
    {
            require VIEWS . 'Article/modification.php';
    }

    /** Enregistrement de l'article **/
    public function store()
    {
        if (isset($_SESSION["user"])) {
            $this->manager->store();
            if (isset($_FILES["photo"])) {
                move_uploaded_file($_FILES["photo"]["tmp_name"], "image/" . $_FILES["photo"]["name"]);
            }
            header("Location: /dashboard");
        }
    }

    /** Enregistrement de l'article **/
    public function storeCommentaire()
    {
        if (isset($_SESSION["user"])) {
            $this->manager->storeCommentaire();
            if (isset($_FILES["photo"])) {
                move_uploaded_file($_FILES["photo"]["tmp_name"], "image/" . $_FILES["photo"]["name"]);
            }
            header("Location: /dashboard");
        }
    }

    /** Suppression de l'article **/
    public function delete($slug)
    {
        //suppression de l'image
        $photo = "";
        $articles = $this->manager->getArticle($slug);
        foreach ($articles as $article) {
            $photo = $article->getPhoto();
        }
        if (!empty($photo)) {
            unlink("image/" . $photo);
        }
        //suppression de l'article
        $this->manager->delete($slug);
        header("Location: /dashboard");
    }



    /** Affichage des articles **/
    public function showAll()
    {
        $articles = $this->manager->getAll();
        require VIEWS . 'Article/index.php';
    }


}
