<?php
return [
    'response' => [
        '200' => [
            'index' => 'You have successfully generated a token',
        ],
        '403' => [
            'missing_token' => 'Missing registration token.',
            'invalid_token_format' => 'Invalid token format.',
            'expired_token' => 'Invalid or expired registration token.',
        ],
    ],
];
