<?php

declare(strict_types=1);

return [
    'connections' => [
        'default' => [
            'name' => 'default',
            'prefix' => 'dbo_',
            'dsn' => 'mysql:host=localhost;dbname=spektral;',
            'username' => 'root',
            'password' => '',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        ],
    ],
    'migration' => [
        'table' => 'migrations'
    ]
];