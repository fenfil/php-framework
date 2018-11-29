<?php

use app\controllers\HomeController;

return [
    'routes' => [
        '/' => [HomeController::class, 'page'],
        'home/{name}' => [HomeController::class, 'hello'],
    ],
];
