<?php


namespace Framework\Providers;


use Framework\Application;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;

abstract class RouteProvider extends Provider {
    protected $router;

    public function __construct(Application $application) {
        parent::__construct($application);
        $this->router = new Router;
    }

    protected function registerRoutes(callable $callback){
        $callback($this->router);
    }

    public function boot(){

        if (php_sapi_name() != 'cli'){
            $response = $this->router->dispatch(request());
            (new SapiEmitter)->emit($response);
        }
    }
}