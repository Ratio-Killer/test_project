<?php
return [
    'response' => [
        '200' => [
            'index' => 'You have successfully retrieved users',
            'store' => 'New user successfully registered',
            'show' => 'You have successfully showed users',
        ],
        '404' => [
            'page_not_found' => 'Page not found',
            'user_not_found' => 'User not found',
        ],
        '409' => [
            'duplicate' => 'User with this phone or email already exist',
        ],
    ],
];
