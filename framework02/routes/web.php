<?php
// routes/web.php

/** @var \League\Route\Router $router */


use App\Controllers\SiteController;

$router->get('/',[SiteController::class,'home']);
$router->post('/',[SiteController::class,'username']);

$router->get('/list',[SiteController::class,'index']);
$router->get('/list/{id}',[SiteController::class,'show']);
$router->post('/list/{id}/delete',[SiteController::class,'delete']);

$router->get('/list/{id}/edit',[SiteController::class,'edit']);
$router->post('/list/{id}/edit',[SiteController::class,'update']);

$router->get('/create',[SiteController::class,'create']);
$router->post('/create',[SiteController::class,'store']);


