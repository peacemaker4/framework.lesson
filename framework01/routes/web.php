<?php
// routes/web.php

/** @var \League\Route\Router $router */


use App\Controllers\SiteController;


$router->get('/',[SiteController::class,'home']);
$router->post('/',[SiteController::class,'username']);

$router->get('/list',[SiteController::class,'index']);

$router->get('/create',[SiteController::class,'create']);
$router->post('/create',[SiteController::class,'store']);


