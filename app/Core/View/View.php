<?php

declare(strict_types=1);

namespace App\Core\View;

final class View
{
    public static function render(
        string $view,
        array $data = [],
        string $layout = 'layouts/main'
    ): void {

        extract($data);

        $view = str_replace(
            '.',
            '/',
            $view
        );

        $viewPath =
            APP_ROOT .
            '/app/Views/' .
            $view .
            '.php';

        $layoutPath =
            APP_ROOT .
            '/app/Views/' .
            $layout .
            '.php';

        ob_start();

        require $viewPath;

        $content = ob_get_clean();

        require $layoutPath;
    }
}
