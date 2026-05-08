<?php

declare(strict_types=1);

namespace App\Core\Http;

final class Response
{
    public static function abort(
        int $code,
        string $message
    ): void {

        http_response_code($code);

        echo $message;

        exit;
    }

    public static function redirect(
        string $url
    ): void {

        header(
            'Location: ' . $url
        );

        exit;
    }
}
