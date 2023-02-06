<?php

namespace Blog\controllers;

use Blog\models\Article;
use Blog\models\ArticleManager;
use DateTimeImmutable;

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
                        ?>
                        <div id="divcommentaires"></div>
                        <div class="blockCard">
                            <div class="cardComment">

                                <div class="top">
                                    <?php echo escape($commentaire->getTitre()); ?>
                                    (posté
                                    <?php
                                    $date = new DateTimeImmutable(escape($commentaire->getDate()));
                                    echo $date->format('D d M Y');
                                    ?> par <?php echo escape($commentaire->getPseudoUser()); ?> )

                                    <form action="/dashboard/<?php echo escape($commentaire->getId_article()); ?>/delete"
                                          method="post">
                                        <?php
                                        if (isset($_SESSION["user"])) {
                                            if ($_SESSION["user"]["pseudo"] == escape($commentaire->getPseudoUser()) || $_SESSION["user"]["role"] == 1) {?>
                                                <button class="button btn-danger" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="16" height="16" fill="currentColor">
                                                        <path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"/>
                                                    </svg>
                                                    <span>Delete</span>
                                                </button>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </form>
                                </div>

                                <div class="top">
                                    <p><?php echo escape($commentaire->getTexte()); ?>
                                </div>
                            </div>
                        </div>
                        <?php
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
