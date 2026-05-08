<?php

declare(strict_types=1);

namespace App\Core\Controller;

use App\Core\View\View;

abstract class BaseController
{
    protected function view(
        string $view,
        array $data = [],
        string $layout = 'layouts/main'
    ): void {

        View::render($view, $data, $layout);
    }

    protected function redirect(string $url): never
    {
        header('Location: ' . $url);

        exit;
    }
}
