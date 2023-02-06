<?php

namespace Blog\controllers;

use Blog\models\Liker;
use Blog\models\LikeManager;



class LikeController
{
    private $manager;

    public function __construct()
    {
        $this->manager = new LikeManager();
    }

    public function storeLiked()
    {

        if (isset($_SESSION["user"])) {
            $this->manager->storeLike();
        }
        header("Location: /dashboard");
    }

    public function like($slug)
    {

        if (isset($_SESSION["user"])) {
            $this->manager->getLike($slug);
        }
        header("Location: /dashboard");
    }

    public function delLike($slug)
    {

        if (isset($_SESSION["user"])) {
            $this->manager->unLike($slug);
        }
        header("Location: /dashboard");
    }

}