<?php
namespace Blog\models;

/** Class Article **/
class Article {
    private $Id_article;
    private $Titre;
    private $Date;
    private $Photo;
    private $Texte;

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

    public function getTexte() {
        return $this->Texte;
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
