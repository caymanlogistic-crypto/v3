<?php

declare(strict_types=1);

namespace App\Core\Middleware;

use App\Core\Auth\Auth;

final class AuthMiddleware
{
    public function handle(): void
    {
        if (!Auth::check()) {

            header(
                'Location: /v3/public/login'
            );

            exit;
        }
    }
}
