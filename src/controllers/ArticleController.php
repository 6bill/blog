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

    /** Enregistrement d'un commentaire **/
    public function storeCommentaire()
    {
        // On vérifie la méthode de la requete AJAX
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // On vérifie si l'utilisateur est connecté
            if (isset($_SESSION['user']['id'])) {
                // L'utilisateur est connecté
                // On récupère les données envoyées en JSON par AJAX
                $donneesJson = file_get_contents('php://input');
                // On convertit les données JSON en objet PHP
                $donnees = json_decode($donneesJson);
                // On vérifie si on a un bien les données à insérer dans la table
                if (isset($donnees->commentaire) && !empty($donnees->commentaire)) {
                    $articles = $this->manager->storeCommentaire($donnees->commentaire, $donnees->IdArticleCommente);
//*************************************************************
//*************************************************************
//*************************************************************
//RENVOIE DU COMMENTAIRE AU FICHIER JS AJAX
                    $output = "";
                    foreach ($articles as $commentaire) {

                        $output .= "<div class='blockCard'>
                            <div class='cardComment'>
                                <div class='top'>
                                    <p>(*** " . $commentaire->getTitre() . " ***)
                                    <hr>
                                    </p>
                                    <p>

                                    <form action='/dashboard/" . $commentaire->getId_article() . "/delete'
                                          method='post'>";

                        if (isset($_SESSION['user'])) {
                            if ($_SESSION['user']['pseudo'] == $commentaire->getPseudoUser() || $_SESSION['user']['role'] == 1) {
                                $output .= "<button class='button btn-danger' type='submit'>
                                <span>Delete</span></button>";
                            }

                        }

                        $output .= "</form>
                                    </p>
                                </div>

                                <div class='top'>
                                    <p>" . $commentaire->getTexte() . "
                                </div>
                            </div>
                        </div>";
                    }
//FIN DU HTML QUI RENVOIE LE COMMENTAIRE EN AJAX
//***********************************************************************************
//***********************************************************************************
//***********************************************************************************


                    echo $output;
                }
            }
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
    public function showArticleByUser($id)
    {
        $output = "";
        $articles = $this->manager->getArticleUser($id);
        require VIEWS . 'Article/index.php';
    }



    public function showOne($id){
        $output = "";
        $articles = $this->manager->getOneArticle($id);
        require VIEWS . 'Article/index.php';
    }

}
