<?php

namespace Blog\tests;

use Blog\models\Article;
use Blog\models\ArticleManager;
use PHPUnit\Framework\TestCase;
require 'src/config/config.php';
class ArticleManagerTest extends TestCase
{

    public function testGetArticleByWords()
    {
        $articleManager = new ArticleManager();
        $_POST['recherche'] = "Qu’est-ce que Composer ?";
        $article = $articleManager->getArticleByWords();
        $this->assertEquals(1, count($article));
    }

    public function testGetAll()
    {
        $articleManager = new ArticleManager();
        $nbArticle = 7;
        $article = $articleManager->getAll();
        $this->assertCount($nbArticle, $article);
    }

    public function testGetArticle()
    {
        //ARRANGE
        $articleManager = new ArticleManager();
        $id = 100;
        $titre = "testTitre";
        $article = new Article();

        //ACT
        $article = $articleManager->getArticle($id)[0];

        //ASSERT
        $this->assertEquals($id, $article->getId_article());
        $this->assertEquals($titre, $article->getTitre());
    }
}
