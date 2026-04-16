<?php

declare(strict_types=1);

return [
    'dsn' => "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4",
    'user' => 'root',
    'password' => $_ENV['DB_PASS'],
];
