<?php
// Product env

return [
    'debug' => filter_var(env('DEBUG', false), FILTER_VALIDATE_BOOLEAN),
    'Datasources' => [
        'default' => [
            'host' => 'localhost',
            'username' => 'myapp',
            'password' => 'dpkadai',
            'database' => 'address_book',
            'timezone' => 'Asia/Tokyo',
        ],
    ],
];
