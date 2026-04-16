<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Controllers;

use HighBornHoney\BlogEngine\Core\Controller;

class CategoryController extends Controller
{
    public function show($id): void
    {
        echo "Category ID: " . $id;
    }
}
