<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Controllers;

use HighBornHoney\BlogEngine\Core\Controller;

class PostController extends Controller
{
    public function show($id): void
    {
        echo "Post ID: " . $id;
    }
}
