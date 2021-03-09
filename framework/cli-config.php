<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Framework\Providers\DatabaseProvider;

require_once __DIR__ . '/bootstrap.php';


$provider = app(DatabaseProvider::class);
$manager = $provider->manager();
return ConsoleRunner::createHelperSet($manager);