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
        $this->view(
            'Modules/Auth/Views/login',
            [
                'old' => Flash::getOld() ?? [],
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
            Flash::setError(
                'Invalid credentials'
            );

            Flash::setOld([
                'email' => $email,
            ]);

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
