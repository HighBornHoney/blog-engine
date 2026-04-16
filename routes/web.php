<?php

$router->get('/', 'HomeController@index');
$router->get('/category/{id}', 'CategoryController@show');
$router->get('/post/{id}', 'PostController@show');
