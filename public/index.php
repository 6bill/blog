<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

$router = new Blog\Router($_SERVER["REQUEST_URI"]);

$router->get('/', "ArticleController@index");
$router->get('/notify/', "ArticleController@showAllNotify");
$router->get('/dashboard/', "ArticleController@showAll");
$router->get('/dashboard/nouveau/', "ArticleController@create");
$router->get('/login/', "UserController@showLogin");
$router->get('/register', "UserController@showRegister");
$router->get('/notify', "ArticleController@showNotify");
$router->get('/dashboard/edit/', "ArticleController@showUpdate");
$router->get('/article/:article/', "ArticleController@showArticleOne");
$router->get('/article/:IdArticle/modify', "ArticleController@showModify");
    $router->get('/articleUser/:user/', "ArticleController@showArticlesUser");

$router->post('/dashboard/nouveau/', "ArticleController@store");
$router->post('/dashboard/:article/delete/', "ArticleController@delete");
$router->post('/login/', "UserController@login");
$router->post('/search/', "ArticleController@login");
$router->post('/register', "UserController@register");
$router->post('/logout/', "UserController@logout");
$router->post('/dashboard/update/', "ArticleController@update");
$router->post('/postCommentaire/', "ArticleController@storeCommentaire");
$router->post('/dashboard/validation/', "ArticleController@validate");
$router->post('/article/searchByWordsArticle/', "ArticleController@searchByWordsArticle");
$router->post('/user/searchByWordsPseudo/', "UserController@searchByWordsPseudo");
$router->post('/dashboard/:article/like/', "ArticleController@Like");

$router->run();