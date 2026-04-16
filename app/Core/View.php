<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Core;

use Smarty\Smarty;

class View
{
    public static function render(string $template, array $data = []): void
    {
        $smarty = new Smarty();

        $smarty->setTemplateDir(__DIR__ . '/../../resources/views/');
        $smarty->setCompileDir(__DIR__ . '/../../storage/compile/');
        $smarty->setCacheDir(__DIR__ . '/../../storage/cache/');

        $smarty->assign($data);

        $smarty->display($template . '.tpl');
    }
}
