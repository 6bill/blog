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
        require VIEWS . 'Article/create.php';
    }
    public function showModify($IdArticle)
    {
        $articles = $this->manager->getArticle($IdArticle);
        $article=$articles[0];
        require VIEWS . 'Article/update.php';
    }
    /** Enregistrement du commentaire **/
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
                $commentaire=$donnees->commentaire;
                $IdArticleCommente=$donnees->IdArticleCommente;

                // On vérifie si on a un bien les données à insérer dans la table
                if (isset($commentaire) && !empty($commentaire)) {
                    $articles = $this->manager->storeCommentaire($commentaire, $IdArticleCommente);
//*************************************************************
//*************************************************************
//************************************************ *************
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

                                $output .= "<button class='button btn-danger' type='submit'
                                                        onclick='return confirm('Etes-vous sur de vouloir supprimer ce métier ?')'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'
                                                         width='16'
                                                         height='16'
                                                         fill='currentColor'>
                                                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path d='M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z'/>
                                                    </svg>
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
        header("Location: /dashboard");
    }
    /** Suppression de l'article **/
    public function delete($id){
        $this->manager->delete($id);
        header("Location: /dashboard");
    }
    public function update(){
        $this->manager->update();
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
    public function like(){
        $this->manager->like();
        header("Location: /dashboard");
    }
    public function showArticlesUser($idUser)
    {
        $articles = $this->manager->getArticlesByUser($idUser);
        require VIEWS . 'Article/index.php';
    }
}