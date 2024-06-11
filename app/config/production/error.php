<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;

return [
    '403' => function (Exception $e, ResponseInterface $response) {
        return view('error/403', ['title' => 'Kesalahan 403 | SPEKTRAL'], $response);
    },
    '404' => function (Exception $e, ResponseInterface $response) {
        return view('error/404', ['title' => 'Kesalahan 404 | SPEKTRAL'], $response);
    },
    '500' => function (Exception $e, ResponseInterface $response) {
        return view('error/500', ['title' => 'Kesalahan 500 | SPEKTRAL'], $response);
    }
];
