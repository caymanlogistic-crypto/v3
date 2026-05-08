<?php

declare(strict_types=1);

namespace App\Modules\Auth\Controllers;

use App\Core\Auth\Auth;
use App\Core\Controller\Controller;
use App\Core\Http\Request;

final class AuthController extends Controller
{
    public function login(): void
    {
        $this->view(
            'Modules/Auth/Views/login'
        );
    }

    public function attempt(): void
    {
        $request = new Request();

        $email = trim(
            $request->input('email')
        );

        $password = trim(
            $request->input('password')
        );

        if (
            !Auth::attempt(
                $email,
                $password
            )
        ) {

            echo 'Invalid credentials';

            return;
        }

        header(
            'Location: /v3/public/contractors'
        );

        exit;
    }

    public function logout(): void
    {
        Auth::logout();

        header(
            'Location: /v3/public/login'
        );

        exit;
    }
}
