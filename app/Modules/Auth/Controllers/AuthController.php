<?php

declare(strict_types=1);

namespace App\Modules\Auth\Controllers;

use App\Core\Auth\Auth;
use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Session\Flash;

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

            Flash::error('Invalid email or password');

            $this->view(
                'Modules/Auth/Views/login',
                [
                    'old' => [
                        'email' => $email,
                    ],
                ]
            );

            return;
        }

        header(
            'Location: ' . config('app.url') . '/contractors'
        );

        exit;
    }

    public function logout(): void
    {
        Auth::logout();

        header(
            'Location: ' . config('app.url') . '/login'
        );

        exit;
    }
}
