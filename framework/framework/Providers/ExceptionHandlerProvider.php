<?php


namespace Framework\Providers;


use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class ExceptionHandlerProvider extends Provider {
    protected $handler;

    public function register() {
        $debug = config('app.debug', false) === true;

        $this->handler = new Run();

        if($debug)
            $this->handler->appendHandler(new PrettyPageHandler);

        $this->handler->register();
        error_reporting((E_ALL ^ E_NOTICE) * $debug);
    }

    public function boot() {

    }
}