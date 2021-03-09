<?php

use Framework\Application;

require_once __DIR__ . '/vendor/autoload.php';

$root = realpath(__DIR__);
Application::start($root);
