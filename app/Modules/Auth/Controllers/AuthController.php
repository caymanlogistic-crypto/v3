<?php

declare(strict_types=1);

namespace App\Modules\Auth\Controllers;

use App\Core\Auth\Auth;
use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Session\Flash;

final class AuthController extends Controller
{
    public function login(): void
    {
        $oldEmail = $_SESSION['old_email'] ?? '';
        unset($_SESSION['old_email']);

        $this->view(
            'Modules/Auth/Views/login',
            [
                'old' => ['email' => $oldEmail],
            ]
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
            Flash::error(
                'Invalid credentials'
            );
            $_SESSION['old_email'] = $email;
            Response::redirect(
                config('app.url') . '/login'
            );
            return;
        }

        Response::redirect(
            config('app.url') . '/contractors'
        );
    }

    public function logout(): void
    {
        Auth::logout();
        Response::redirect(
            config('app.url') . '/login'
        );
    }
}