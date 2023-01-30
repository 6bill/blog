<?php

namespace Blog\controllers;

use Blog\models\Article;
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

    /** HomePage **/
    public function verify()
    {
        $articles = $this->manager->getStatue0();

        require VIEWS . 'Article/verify.php';
    }

    /** Formulaire de modification d'article **/
    public function modification()
    {
        $articles = $this->manager->getArticle($_POST['IDARTICLE']);
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
    /** Enregistrement de l'article **/
    public function storeModif()
    {
        if (isset($_SESSION["user"])) {
            $this->manager->updateArticle();
        }
        header("Location: /dashboard");

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

    public function check()
    {
        $this->manager->checkACT();
        header("Location: /verify");
    }

    /** Formulaire de recherche d'un article par mots clefs **/
    public function searchArticleByWords()
    {
        $output = "";
        $articles = $this->manager->getArticleByWords();
        if ($articles) {
            foreach ($articles as $article) {
                $output .= "<a  href='/article/" . $article->getId_article() . "'>" . $article->getTitre() . "</a><br>";
            }
            echo $output;
        }
    }

    /** Formulaire de recherche d'un article par mots clefs **/
    public function searchArticleByPseudo()
    {
        $output = "";
        $articles = new Article();
        $users = $this->manager->getArticleByPseudo();
        if ($users) {
            foreach ($users as $user) {
                foreach ($articles as $article) {
                    $output .= "<a  href='/article/" . $article->getId_article() . "'>" . $user->getPseudo() . "</a><br>";

                    echo $output;
                }
            }
        }
    }

    public function showOne(){
        $this->manager->getOneArticle();
        require VIEWS . 'Article/index.php';
    }

    public function showArticleByPseudo(){
        $this->manager->getArticleByPseudo();
        require VIEWS . 'Article/index.php';
    }
}
