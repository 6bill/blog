<?php

namespace Blog\models;

class Liker
{
    private $id_like;
    private $id_user;
    private $id_article;

    /**
     * @return mixed
     */
    public function getIdLike()
    {
        return $this->id_like;
    }

    /**
     * @param mixed $id_like
     */
    public function setIdLike($id_like)
    {
        $this->id_like = $id_like;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->id_article;
    }

    /**
     * @param mixed $id_article
     */
    public function setIdArticle($id_article)
    {
        $this->id_article = $id_article;
    }


}