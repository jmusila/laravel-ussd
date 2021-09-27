<?php

return [
    'sandbox' => [
        'username' => env('SANDBOX_USERNAME', "sandbox"),
        'api_key' => env('SANDBOX_API_KEY', "NOAPIKEY")
    ],
    'production' => [
        'username' => env('PRODUCTION_USERNAME', "sandbox"),
        'api_key' => env('PRODUCTION_API_KEY', "NOAPIKEY")
    ]
];