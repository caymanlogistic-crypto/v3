<?php

declare(strict_types=1);

namespace App\Core\Middleware;

use App\Core\Http\Request;
use App\Core\Http\Response;

final class CsrfMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, callable $next): mixed
    {
        $token = $request->input('_token');

        if (!csrf_verify(is_string($token) ? $token : null)) {
            Response::abort(419, '419 CSRF token mismatch');
        }

        return $next($request);
    }
}
