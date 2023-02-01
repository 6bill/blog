<?php

namespace Blog\models;

use Blog\models\Liker;
use Blog\models\UserManager;
use Blog\models\ArticleManager;


class LikeManager
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }


    public function storeLike()
    {
        $stmt = $this->bdd->prepare("INSERT INTO like(id_user,id_Article ) VALUES (?, ?)");
        $retour = $stmt->execute(array(
            $_SESSION["user"]["id"],
            $_POST["IDARTICLE"],
        ));
        return $retour;
    }
}