<?php

declare(strict_types=1);

use App\Core\Exceptions\ExceptionHandler;
use App\Core\Http\Request;
use App\Core\Routing\Router;

require_once __DIR__ . '/../bootstrap/app.php';

ExceptionHandler::register();

$request = new Request();

$router = new Router();

require_once __DIR__ . '/../routes/web.php';

$router->dispatch(
    $request->method(),
    $request->uri()
);
