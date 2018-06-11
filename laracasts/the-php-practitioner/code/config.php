<?php

return [
    'database' => [
        'name' => 'lrn_lara_practitioner',
        'username' => 'root',
        'password' => 'root',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION # we can use also ERRMODE_WARNING
        ]
    ]
];
