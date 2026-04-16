<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Controllers;

use HighBornHoney\BlogEngine\Core\Controller;
use HighBornHoney\BlogEngine\Models\CategoryModel;

class HomeController extends Controller
{
    public function index(): void
    {
        $categories = CategoryModel::getWithLatestPosts(3);

        $this->view('home', [
            'categories' => $categories
        ]);
    }
}
