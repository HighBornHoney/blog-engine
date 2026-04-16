<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Controllers;

use HighBornHoney\BlogEngine\Core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        echo "Home works";
    }
}
