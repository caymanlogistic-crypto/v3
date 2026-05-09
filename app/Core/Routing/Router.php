<?php

declare(strict_types=1);

namespace App\Core\Routing;

use App\Core\Http\Request;

final class Router
{
    private array $routes = [];

    public function get(
        string $uri,
        callable $handler,
        array $middlewares = []
    ): void {

        $this->addRoute(
            'GET',
            $uri,
            $handler,
            $middlewares
        );
    }

    public function post(
        string $uri,
        callable $handler,
        array $middlewares = []
    ): void {

        $this->addRoute(
            'POST',
            $uri,
            $handler,
            $middlewares
        );
    }

    private function addRoute(
        string $method,
        string $uri,
        callable $handler,
        array $middlewares
    ): void {

        $this->routes[$method][] = [
            'uri' => $this->normalize($uri),
            'handler' => $handler,
            'middlewares' => $middlewares,
        ];
    }

    public function dispatch(
        string $method,
        string $uri
    ): void {

        $uri = $this->normalize($uri);

        if (
            str_starts_with(
                $uri,
                '/v3/public'
            )
        ) {

            $uri = substr(
                $uri,
                strlen('/v3/public')
            );
        }

        if ($uri === '') {
            $uri = '/';
        }

        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $route) {

            $pattern = preg_replace(
                '#\{[a-zA-Z_]+\}#',
                '([^/]+)',
                $route['uri']
            );

            $pattern = '#^' . $pattern . '$#';

            if (
                !preg_match(
                    $pattern,
                    $uri,
                    $matches
                )
            ) {
                continue;
            }

            array_shift($matches);

            preg_match_all(
                '#\{([a-zA-Z_]+)\}#',
                $route['uri'],
                $paramNames
            );

            $params = [];

            foreach (
                $paramNames[1] as $index => $name
            ) {

                $params[$name] =
                    $matches[$index]
                    ?? null;
            }

            $request = new Request();

            $next = static function (Request $request) use (
                $route,
                $params
            ): void {
                call_user_func(
                    $route['handler'],
                    $params
                );
            };

            foreach (
                array_reverse($route['middlewares'])
                as $middleware
            ) {
                $next = static function (Request $request) use (
                    $middleware,
                    $next
                ): mixed {
                    if (
                        str_contains(
                            $middleware,
                            ':'
                        )
                    ) {
                        [
                            $class,
                            $parameter
                        ] = explode(
                            ':',
                            $middleware,
                            2
                        );

                        $instance = new $class(
                            $parameter
                        );
                    } else {
                        $instance = new $middleware();
                    }

                    return $instance->handle(
                        $request,
                        $next
                    );
                };
            }

            $next($request);

            return;
        }

        http_response_code(404);

        echo '404 Not Found';
    }

    private function normalize(
        string $uri
    ): string {

        $uri = rtrim($uri, '/');

        return $uri === ''
            ? '/'
            : $uri;
    }
}
