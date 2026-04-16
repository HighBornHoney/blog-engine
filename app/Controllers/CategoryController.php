<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Controllers;

use HighBornHoney\BlogEngine\Core\Controller;
use HighBornHoney\BlogEngine\Models\CategoryModel;
use HighBornHoney\BlogEngine\Models\PostModel;

class CategoryController extends Controller
{
    public function show($id): void
    {
        $category = CategoryModel::find($id);

        if (!$category) {
            $this->errorResponse('Категория не найдена');
        }

        $sort = $_GET['sort'] ?? 'date';
        $page = (int)($_GET['page'] ?? 1);

        $posts = PostModel::getByCategory($id, $sort, $page);
        $total = PostModel::countByCategory($id);

        $perPage = 5;
        $pages = ceil($total / $perPage);

        $this->view('category', [
            'posts' => $posts,
            'category' => $category,
            'sort' => $sort,
            'page' => $page,
            'pages' => $pages
        ]);
    }
}
