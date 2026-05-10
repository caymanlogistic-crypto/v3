<?php

declare(strict_types=1);

use App\Core\Database\Database;
use App\Core\Http\Request;
use App\Core\Middleware\AuthMiddleware;
use App\Core\Middleware\CsrfMiddleware;
use App\Core\Middleware\PermissionMiddleware;

use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Contractors\Controllers\ContractorsController;
use App\Modules\Contractors\Controllers\ContractorContactsController;
use App\Modules\Home\Controllers\HomeController;

$router->get(
    '/',
    static function (): void {
        (new HomeController())->index();
    }
);

$router->get(
    '/login',
    static function (): void {
        (new AuthController())->login();
    }
);

$router->post(
    '/login',
    static function (): void {
        (new AuthController())->attempt();
    },
    [
        CsrfMiddleware::class,
    ]
);

$router->post(
    '/logout',
    static function (): void {
        (new AuthController())->logout();
    },
    [
        AuthMiddleware::class,
        CsrfMiddleware::class,
    ]
);

$router->get(
    '/db-test',
    static function (): void {

        $pdo = Database::connection();

        $result = $pdo->query(
            'SELECT NOW() as time'
        );

        $row = $result->fetch();

        echo '<pre>';

        print_r($row);

        echo '</pre>';
    },
    [
        AuthMiddleware::class,
    ]
);

$router->get(
    '/contractors',
    static function (): void {

        (new ContractorsController())->index(
            new Request()
        );
    },
    [
        AuthMiddleware::class,
        PermissionMiddleware::class . ':contractors.view',
    ]
);

$router->get(
    '/contractors/create',
    static function (): void {

        (new ContractorsController())->create(
            new Request()
        );
    },
    [
        AuthMiddleware::class,
        PermissionMiddleware::class . ':contractors.create',
    ]
);

$router->post(
    '/contractors/store',
    static function (): void {

        (new ContractorsController())->store(
            new Request()
        );
    },
    [
        AuthMiddleware::class,
        CsrfMiddleware::class,
        PermissionMiddleware::class . ':contractors.create',
    ]
);

$router->get(
    '/contractors/{id}/edit',
    static function (array $params): void {

        (new ContractorsController())->edit(
            new Request(),
            $params
        );
    },
    [
        AuthMiddleware::class,
        PermissionMiddleware::class . ':contractors.edit',
    ]
);

$router->post(
    '/contractors/{id}/update',
    static function (array $params): void {

        (new ContractorsController())->update(
            new Request(),
            $params
        );
    },
    [
        AuthMiddleware::class,
        CsrfMiddleware::class,
        PermissionMiddleware::class . ':contractors.edit',
    ]
);

$router->post(
    '/contractors/{id}/delete',
    static function (array $params): void {

        (new ContractorsController())->delete(
            new Request(),
            $params
        );
    },
    [
        AuthMiddleware::class,
        CsrfMiddleware::class,
        PermissionMiddleware::class . ':contractors.edit',
    ]
);

$router->post(
    '/contractors/{id}/contacts/store',
    static function (array $params): void {

        (new ContractorContactsController())->store(
            new Request(),
            $params
        );
    },
    [
        AuthMiddleware::class,
        CsrfMiddleware::class,
        PermissionMiddleware::class . ':contractors.edit',
    ]
);

$router->post(
    '/contractors/contacts/{id}/update',
    static function (array $params): void {

        (new ContractorContactsController())->update(
            new Request(),
            $params
        );
    },
    [
        AuthMiddleware::class,
        CsrfMiddleware::class,
        PermissionMiddleware::class . ':contractors.edit',
    ]
);

$router->post(
    '/contractors/contacts/{id}/delete',
    static function (array $params): void {

        (new ContractorContactsController())->delete(
            new Request(),
            $params
        );
    },
    [
        AuthMiddleware::class,
        CsrfMiddleware::class,
        PermissionMiddleware::class . ':contractors.edit',
    ]
);
