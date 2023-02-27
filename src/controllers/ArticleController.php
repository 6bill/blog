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
                                    <h3>".$commentaire->getTitre() ."</h3>
                                </div>
                                <div class='separator'></div>
                                <div class='top padding'>
                                    <p>".$commentaire->getTexte() ."</p>
                                </div>
                                <div class='separator'></div>
                                <form action='/dashboard/" . $commentaire->getId_article() . "/delete'
                                      method='post' id='formDeleteCommentaire'>";
                                    if (isset($_SESSION['user'])) {
                                        if ($_SESSION['user']['pseudo'] == escape($commentaire->getPseudoUser()) || $_SESSION['user']['role'] == 'admin') {
                                            $output .= "<button class='button btn-danger' type='submit' id='deleteCommentaire'
                                                 onclick='return confirm('Êtes-vous sur de vouloir supprimer ce métier ?')'>
                                                <img src='/image/trash.png' alt='trash' id='trash'>
                                            </button>";
                                        }
                                    }
                                    $output.= "</form>
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
    public function unLike(){
        $this->manager->unLike();
        header("Location: /dashboard");
    }
    public function showArticlesUser($idUser)
    {
        $articles = $this->manager->getArticlesByUser($idUser);
        require VIEWS . 'Article/index.php';
    }
}