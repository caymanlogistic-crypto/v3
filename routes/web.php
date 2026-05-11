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
use App\Modules\Contractors\Controllers\ContractorDadataController;
use App\Modules\Contractors\Controllers\ContractorFilesController;
use App\Modules\Drivers\Controllers\DriverFilesController;
use App\Modules\Drivers\Controllers\DriversController;
use App\Modules\Home\Controllers\HomeController;
use App\Modules\Vehicles\Controllers\VehicleFilesController;
use App\Modules\Vehicles\Controllers\VehiclesController;

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

$router->post(
    '/contractors/{id}/files/upload',
    static function (array $params): void {

        (new ContractorFilesController())->upload(
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

$router->get(
    '/contractors/files/{id}/download',
    static function (array $params): void {

        (new ContractorFilesController())->download(
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
    '/contractors/files/{id}/delete',
    static function (array $params): void {

        (new ContractorFilesController())->delete(
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
    '/contractors/dadata/lookup',
    static function (): void {

        (new ContractorDadataController())->lookup(
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
    '/drivers',
    static function (): void {

        (new DriversController())->index(
            new Request()
        );
    },
    [
        AuthMiddleware::class,
        PermissionMiddleware::class . ':contractors.view',
    ]
);

$router->get(
    '/drivers/create',
    static function (): void {

        (new DriversController())->create(
            new Request()
        );
    },
    [
        AuthMiddleware::class,
        PermissionMiddleware::class . ':contractors.create',
    ]
);

$router->post(
    '/drivers/store',
    static function (): void {

        (new DriversController())->store(
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
    '/drivers/{id}/edit',
    static function (array $params): void {

        (new DriversController())->edit(
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
    '/drivers/{id}/update',
    static function (array $params): void {

        (new DriversController())->update(
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
    '/drivers/{id}/delete',
    static function (array $params): void {

        (new DriversController())->delete(
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
    '/drivers/{id}/files/upload',
    static function (array $params): void {

        (new DriverFilesController())->upload(
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

$router->get(
    '/drivers/files/{id}/download',
    static function (array $params): void {

        (new DriverFilesController())->download(
            new Request(),
            $params
        );
    },
    [
        AuthMiddleware::class,
        PermissionMiddleware::class . ':contractors.view',
    ]
);

$router->post(
    '/drivers/files/{id}/delete',
    static function (array $params): void {

        (new DriverFilesController())->delete(
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

$router->get(
    '/vehicles',
    static function (): void {

        (new VehiclesController())->index(
            new Request()
        );
    },
    [
        AuthMiddleware::class,
        PermissionMiddleware::class . ':contractors.view',
    ]
);

$router->get(
    '/vehicles/create',
    static function (): void {

        (new VehiclesController())->create(
            new Request()
        );
    },
    [
        AuthMiddleware::class,
        PermissionMiddleware::class . ':contractors.create',
    ]
);

$router->post(
    '/vehicles/store',
    static function (): void {

        (new VehiclesController())->store(
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
    '/vehicles/{id}/edit',
    static function (array $params): void {

        (new VehiclesController())->edit(
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
    '/vehicles/{id}/update',
    static function (array $params): void {

        (new VehiclesController())->update(
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
    '/vehicles/{id}/delete',
    static function (array $params): void {

        (new VehiclesController())->delete(
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
    '/vehicles/{id}/files/upload',
    static function (array $params): void {

        (new VehicleFilesController())->upload(
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

$router->get(
    '/vehicles/files/{id}/download',
    static function (array $params): void {

        (new VehicleFilesController())->download(
            new Request(),
            $params
        );
    },
    [
        AuthMiddleware::class,
        PermissionMiddleware::class . ':contractors.view',
    ]
);

$router->post(
    '/vehicles/files/{id}/delete',
    static function (array $params): void {

        (new VehicleFilesController())->delete(
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
