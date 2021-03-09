<?php


namespace App\Providers;


use Framework\Providers\RouteProvider as Provider;
use League\Route\Router;

class RouteProvider extends Provider {

    function register() {
        $this->registerRoutes(function (Router $router){
            require path('routes/web.php');
        });
    }

}