<?php

declare(strict_types=1);

namespace App\Core\Middleware;

use App\Core\Auth\Auth;
use App\Core\Http\Request;
use App\Core\Http\Response;

final class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, callable $next): mixed
    {
        if (!Auth::check()) {
            Response::redirect(
                config('app.url') . '/login'
            );
        }

        return $next($request);
    }
}
