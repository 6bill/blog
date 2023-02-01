<?php

namespace Blog\models;


/** Class Commentaire **/
class Commentaire extends Article
{
    private $IdArticleCommente;

    /**
     * @return mixed
     */
    public function getIdArticleCommente()
    {
        return $this->IdArticleCommente;
    }

    /**
     * @param mixed $IdArticleCommente
     */
    public function setIdArticleCommente($IdArticleCommente)
    {
        $this->IdArticleCommente = $IdArticleCommente;
    }



}
