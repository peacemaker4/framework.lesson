<?php

return [
    'models' => path('app/Models'),
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'driver' => 'pdo_mysql',
            'user' => 'root',
            'password' => 'root',
            'dbname' => 'framework'
        ]
    ],
];