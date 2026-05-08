<?php

declare(strict_types=1);

namespace App\Core\Middleware;

use App\Core\Auth\Auth;

final class PermissionMiddleware
{
    private string $permission;

    public function __construct(
        string $permission
    ) {

        $this->permission = $permission;
    }

    public function handle(): void
    {
        if (
            !Auth::can(
                $this->permission
            )
        ) {

            http_response_code(403);

            echo '403 Access Denied';

            exit;
        }
    }
}
