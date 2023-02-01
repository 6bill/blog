<?php

namespace Blog\controllers;

use Blog\models\LikeManager;


class LikeController
{
    private $manager;

    public function __construct()
    {
        $this->manager = new LikeManager();
    }

    public function storeLike()
    {
        if (isset($_SESSION["user"])) {
            $this->manager->storeLike();
            header("Location: /dashboard");
        }
    }
}