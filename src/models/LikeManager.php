<?php

namespace Blog\models;

use Blog\models\Liker;
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
        $stmt = $this->bdd->prepare("INSERT INTO `like` (Id_user,Id_article ) VALUES (?, ?)");
        $stmt->execute(array(
            $_SESSION["user"]["id"],
            $_POST['IDARTICLE'],
        ));
    }
    public function getLike($id)
    {
        $stmt = $this->bdd->prepare("SELECT * FROM `like` WHERE Id_article = ? AND Id_user = ?");
        $stmt->execute(array(
            $id,
            $_SESSION["user"]["id"],
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS,"Blog\Models\Liker");

    }
    public function unLike($id)
    {
        $stmt = $this->bdd->prepare("DELETE FROM `like` WHERE Id_article = ? AND Id_user = ?");
        $stmt->execute(array(
            $id,
            $_SESSION["user"]["id"],
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS,"Blog\Models\Liker");

    }
}