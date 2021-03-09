<?php


namespace Framework\Providers;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class DatabaseProvider extends Provider {
    protected $setup;
    protected $manager;

    protected function registerSetup(){
        $debug = config('app.debug') === true;
        $paths = config('database.models', []);

        $paths = is_array($paths) ? $paths : [$paths];
        $this->setup = Setup::createAnnotationMetadataConfiguration(
            $paths, $debug, null, null, false
        );
    }

    protected function registerManager(){
        $connections = config('database.connections', []);
        $default = config('database.default');

        if(!$default)
            throw new \Exception('Database default connections must be provided.');

        $connection = $connections[$default] ?? null;

        if(empty($connection))
            throw new \Exception("Chosen connection is not valid.");

        $this->manager = EntityManager::create($connection, $this->setup);
    }

    function register() {
        $this->registerSetup();
        $this->registerManager();
    }

    function manager(){
        return $this->manager;
    }

    function boot() {
        // TODO: Implement boot() method.
    }
}