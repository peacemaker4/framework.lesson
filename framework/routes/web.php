<?php
// routes/web.php

/** @var \League\Route\Router $router */


use App\Controllers\SiteController;


$router->get('/',[SiteController::class,'index']);

$router->get('/create',[SiteController::class,'create']);
$router->post('/create',[SiteController::class,'store']);

//foreach ($router as $path){
//    echo $path[1]. "\n";
//}die;
