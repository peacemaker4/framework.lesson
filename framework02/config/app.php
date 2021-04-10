<?php

use App\Providers\RouteProvider;
use Framework\Providers\DatabaseProvider;
use Framework\Providers\ExceptionHandlerProvider;
use Framework\Providers\HttpProvider;
use Framework\Providers\ViewProvider;

return [
    'name' => 'Framework :)',
    'debug' => true,
    'providers' => [
        /* Framework providers */
        ExceptionHandlerProvider::class,
        HttpProvider::class,

        /* App providers */
        RouteProvider::class,
        ViewProvider::class,
        DatabaseProvider::class,
    ]
];