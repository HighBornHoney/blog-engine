<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Controllers;

use HighBornHoney\BlogEngine\Core\Controller;
use HighBornHoney\BlogEngine\Models\PostModel;

class PostController extends Controller
{
    public function show($id): void
    {
        $post = PostModel::find($id);

        if (!$post) {
            $this->errorResponse('Публикация не найдена');
        }

        PostModel::incrementViews($id);

        $related = PostModel::getRelated($id);

        $this->view('post', [
            'post' => $post,
            'related' => $related
        ]);
    }
}
