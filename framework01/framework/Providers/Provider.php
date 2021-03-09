<?php
namespace Framework\Providers;

use Framework\Application;

abstract class Provider{
    protected $app;

    public function __construct(Application $application) {
        $this->app = $application;
    }

    abstract function register();
    abstract function boot();
}