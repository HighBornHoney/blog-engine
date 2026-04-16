<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Controllers;

use HighBornHoney\BlogEngine\Core\Controller;
use HighBornHoney\BlogEngine\Models\PostModel;

class CategoryController extends Controller
{
    public function show($id): void
    {
        $sort = $_GET['sort'] ?? 'date';
        $page = (int)($_GET['page'] ?? 1);

        $posts = PostModel::getByCategory($id, $sort, $page);
        $total = PostModel::countByCategory($id);

        $perPage = 5;
        $pages = ceil($total / $perPage);

        $this->view('category', [
            'posts' => $posts,
            'category_id' => $id,
            'sort' => $sort,
            'page' => $page,
            'pages' => $pages
        ]);
    }
}
