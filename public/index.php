<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

$router = new Blog\Router($_SERVER["REQUEST_URI"]);

$router->get('/', "ArticleController@index");
$router->get('/dashboard/', "ArticleController@showAll");
$router->get('/dashboard/nouveau/', "ArticleController@create");

$router->post('/dashboard/:article/delete/', "ArticleController@delete");
$router->post('/dashboard/nouveau/', "ArticleController@store");


$router->run();
