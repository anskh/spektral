<?php

declare(strict_types=1);

return [
    'from' => 'noreply-1400@bps.go.id',
    'config' => [
        'smtp_server' => 'smtp.bps.go.id',
        'smtp_port' => 587,
        'options' => [
            'user' => 'ipds1400@bps.go.id',
            'pass' => '1pd51400',
            'timeout'=> 60,
            'client_domain' => 'Corephp',
            'ssl' => [
                'verify_peer' => false
            ],
            'debug' => false
        ]
    ]
];