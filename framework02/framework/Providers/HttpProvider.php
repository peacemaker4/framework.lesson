<?php


namespace Framework\Providers;


use Laminas\Diactoros\ServerRequestFactory;
use Psr\Http\Message\RequestInterface;

class HttpProvider extends Provider {
    protected $request;

    function register() {
        $this->request = ServerRequestFactory::fromGlobals();
    }

    function request(): RequestInterface {
        return $this->request;
    }

    function boot() {
    }
}