<?php
namespace Blog\models;

/** Class Article **/
class Article {
    private $Id_article;
    private $Titre;
    private $Date;
    private $Photo;
    private $Texte;
    private $Id_user;

    public function getId_article() {
        return $this->Id_article;
    }

    public function getTitre() {
        return $this->Titre;
    }

    public function getPhoto() {
        return $this->Photo;
    }

    public function getDate() {
        return $this->Date;
    }

    /**
     * @return mixed
     */
    public function getTexte()
    {
        return $this->Texte;
    }

    /**
     * @return mixed
     */
    public function getId_user()
    {
        return $this->Id_user;
    }


    //faux getter pour récupérer le pseudo du user qui a écrit l'article
    public function getPseudoUser() {
        $outilmanager= new UserManager();
        return $outilmanager->getUserById($this->getId_user())->getPseudo();
    }

    /**
     * @param mixed $Id_user
     */
    public function setIdUser($Id_user)
    {
        $this->Id_user = $Id_user;
    }

     public function setId_article(Int $Id_article) {
        $this->Id_article = $Id_article;
    }

    public function setTitre(string $Titre) {
        $this->Titre = $Titre;
    }

    public function setDate(String $Date) {
        $this->Date = $Date;
    }

    public function setPhoto(String $Photo) {
        $this->Photo = $Photo;
    }

    public function setTexte(String $Texte) {
        $this->Texte = $Texte;
    }
}
