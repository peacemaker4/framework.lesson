<?php


namespace Framework\Services;


use Framework\Application;
use Framework\Services;

abstract class Service {
    /**
     * @var Application
     */
    protected  $app;

    public function __construct(Application $app) {
        $this->app = $app;
    }
}