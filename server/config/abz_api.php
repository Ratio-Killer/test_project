<?php

return [
    'url' => env('ABZ_API_URL'),
    'routes' => [
        'token' => '/token',
        'users' => '/users',
        'positions' => '/positions',
    ],
    'random_image_url' => env('RANDOM_IMAGE_URL')
];
