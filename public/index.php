<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use HighBornHoney\BlogEngine\Core\Router;

$router = new Router();

require_once __DIR__ . '/../routes/web.php';

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);
