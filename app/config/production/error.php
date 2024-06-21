<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;

return [
    '403' => function (Exception $e, ResponseInterface $response) {
        return view('403', ['title' => 'Kesalahan 403 | SPEKTRAL', 'error'=>$e], $response, 'error');
    },
    '404' => function (Exception $e, ResponseInterface $response) {
        return view('404', ['title' => 'Kesalahan 404 | SPEKTRAL', 'error'=>$e], $response, 'error');
    },
    '500' => function (Exception $e, ResponseInterface $response) {
        return view('500', ['title' => 'Kesalahan 500 | SPEKTRAL', 'error'=>$e], $response, 'error');
    }
];
