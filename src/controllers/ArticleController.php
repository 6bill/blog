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
    public function showNotify () {
        require VIEWS . 'Article/notify.php';
    }
    /** Formulaire de création d'article **/
    public function create()
    {
        require VIEWS . 'Article/create.php';
    }
    public function showUpdate()
    {
        require VIEWS . 'Article/update.php';
    }
    /** Enregistrement du commentaire **/
    public function storeCommentaire () {
        $this->manager->storeCommentaire();
        if (isset($_FILES["photo"])) {
            move_uploaded_file($_FILES["photo"]["tmp_name"], "image/" . $_FILES["photo"]["name"]);
        }
        header("Location: /dashboard");
    }
    /** Enregistrement de l'article **/
    public function store()
    {
        $this->manager->store();
        if (isset($_FILES["photo"])) {
            move_uploaded_file($_FILES["photo"]["tmp_name"], "image/" . $_FILES["photo"]["name"]);
        }
        header("Location: /dashboard");
    }
    public function validate () {
        $this->manager->validate();
        header("Location: /notify");
    }
    /** Suppression de l'article **/
    public function delete($id){
        $this->manager->delete($id);
        header("Location: /dashboard");
    }
        public function update($id){
        $this->manager->update($id);
        header("Location: /dashboard");
    }
    public function searchByWordsArticle()
    {
        $output = "";
        $articles = $this->manager->getArticleByWords();
        if ($articles) {
            foreach ($articles as $article) {
                $output .= "<a href='/article/" . $article->getId_article() . "'>" . $article->getTitre() . "</a><br>";
            }
            echo $output;
        }
    }
    public function showArticleOne($slug)
    {
        $articles = $this->manager->getArticle($slug);
        require VIEWS . 'Article/index.php';

    }
    /** Affichage des articles **/
    public function showAll()
    {
        $articles = $this->manager->getAll();
        require VIEWS . 'Article/index.php';
    }
    public function showAllNotify()
    {
        $articles = $this->manager->getNotify();
        require VIEWS . 'Article/notify.php';
    }
}