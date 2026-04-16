<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Core;

use JetBrains\PhpStorm\NoReturn;

class Controller
{
    protected function view(string $template, array $data = []): void
    {
        View::render($template, $data);
    }

    #[NoReturn] protected function errorResponse(string $message, int $code = 404): never
    {
        http_response_code(404);

        $this->view('error', compact('message'));

        exit;
    }
}
