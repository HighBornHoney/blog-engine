<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Core;

class Controller
{
    protected function view(string $template, array $data = []): void
    {
        View::render($template, $data);
    }
}
