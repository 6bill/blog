<?php

namespace Blog\models;

class Like
{
    private $Id_article;
    private $Id_user;

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->Id_article;
    }

    /**
     * @param mixed $Id_article
     */
    public function setIdArticle($Id_article): void
    {
        $this->Id_article = $Id_article;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->Id_user;
    }

    /**
     * @param mixed $Id_user
     */
    public function setIdUser($Id_user): void
    {
        $this->Id_user = $Id_user;
    }
}
