<?php

declare(strict_types=1);

namespace App\Core\Middleware;

use App\Core\Auth\Auth;
use App\Core\Http\Request;
use App\Core\Http\Response;

final class PermissionMiddleware implements MiddlewareInterface
{
    private string $permission;

    public function __construct(
        string $permission
    ) {

        if (str_contains($permission, ':')) {
            $this->permission = explode(':', $permission, 2)[1];
        } else {
            $this->permission = $permission;
        }
    }

    public function handle(Request $request, callable $next): mixed
    {
        if (
            !Auth::can(
                $this->permission
            )
        ) {
            Response::abort(
                403,
                '403 Access Denied'
            );
        }

        return $next($request);
    }
}
