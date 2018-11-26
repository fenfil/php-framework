<?php

use App\Controllers\HomeController;

return [
    'routes' => [
        '/' => [HomeController::class, 'page'],
        'home/{name}' => [HomeController::class, 'hello'],
    ],
];
