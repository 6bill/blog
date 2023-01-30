<?php

namespace Blog\models;


/** Class Article **/
class Article
{
    protected $Id_article;
    protected $Titre;
    protected $Date;
    protected $Photo;
    protected $Texte;
    protected $Id_user;
    public function getId_article()
    {
        return $this->Id_article;
    }

    public function getTitre()
    {
        return $this->Titre;
    }

    public function getPhoto()
    {
        return $this->Photo;
    }

    public function getDate()
    {
        return $this->Date;
    }

    public function getTexte()
    {
        return $this->Texte;
    }

    public function getId_user()
    {
        return $this->Id_user;
    }

    public function setId_article(int $Id_article)
    {
        $this->Id_article = $Id_article;
    }

    public function setTitre(string $Titre)
    {
        $this->Titre = $Titre;
    }

    public function setDate(string $Date)
    {
        $this->Date = $Date;
    }

    public function setPhoto(string $Photo)
    {
        $this->Photo = $Photo;
    }

    public function setTexte(string $Texte)
    {
        $this->Texte = $Texte;
    }

    public function setId_user(int $Id_user)
    {
        $this->Id_user = $Id_user;

    }

    public function getPseudoUser()
    {
        $userManagement = new UserManager();
        $user = $userManagement->getUserbyId($this->getId_user())[0];

        return $user->getPseudo();
    }


    //faux getter pour récupérer les commentaires de l'article
    public function getCommentaires()
    {  //on appelle la méthode "getArticleCommentaires" de l'ArticleManager
        $ArticleManagement = new ArticleManager();
        $commentaires = $ArticleManagement->getArticleCommentaires($this->getId_article());
        //on récupère un array list des commentaires
        //ou un array list vide si l'article n'a pas de commentaires
        return $commentaires;
    }
}
