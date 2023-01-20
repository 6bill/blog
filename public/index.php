<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

$router = new Blog\Router($_SERVER["REQUEST_URI"]);

$router->get('/', "ArticleController@index");
$router->get('/verify', "ArticleController@verify");
$router->get('/dashboard/', "ArticleController@showAll");
$router->get('/dashboard/nouveau/', "ArticleController@create");
$router->get('/login', "UserController@index");
$router->get('/register', "UserController@showRegister");
$router->get('/logout', "UserController@logout");
$router->get('/dashboard/:article/modification/', "ArticleController@modification");




$router->post('/dashboard/:article/delete/', "ArticleController@delete");
$router->post('/dashboard/:article/commentaire/', "ArticleController@storeCommentaire");
$router->post('/dashboard/nouveau/', "ArticleController@store");
$router->post('/login', "UserController@login");
$router->post('/register', "UserController@register");
$router->post('/logout', "UserController@logout");


$router->run();
