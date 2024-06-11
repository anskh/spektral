<?php

declare(strict_types=1);

use App\Middleware\AuthMiddleware;
use Corephp\Middleware\DispatcherMiddleware;
use Corephp\Middleware\FastRouteMiddleware;
use Corephp\Middleware\SessionMiddleware;

return [
    ['id' => 'fastroute','middleware' => make(FastRouteMiddleware::class)],
    ['id' => 'session','middleware' => make(SessionMiddleware::class)],
    ['id' => 'auth','middleware' => make(AuthMiddleware::class)],
    ['id' => 'dispatcher','middleware' => make(DispatcherMiddleware::class)]
];