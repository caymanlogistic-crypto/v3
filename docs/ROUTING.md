# Routing

## Custom router behavior

- Routes are registered in `routes/web.php` using `App\Core\Routing\Router`.
- Supported methods: `GET`, `POST`.
- `Router::addRoute()` stores routes by HTTP method.
- `Router::dispatch()` normalizes the URI and matches routes using regex.
- URI parameters are defined with `{param}` and extracted dynamically.

## Route parameters

- Parameter syntax: `/contractors/{id}/edit`.
- The router converts route templates into regex patterns.
- Extracted parameter names are passed to the handler as an array.
- Route handlers receive `array $params` for URI variables.

## Middleware behavior

- Middleware classes are specified per route as an array.
- Each middleware is instantiated and `handle()` is called before the route handler.
- Middleware can be passed parameters using `ClassName:parameter` syntax.
- Example: `PermissionMiddleware::class . ':contractors.view'`.

## Current limitations

- Middleware is instantiated manually and lacks a dependency container.
- Middleware parameter parsing is brittle and string-based.
- Route definitions create controller instances inside closures.
- Hardcoded public path normalization exists in `Router::dispatch()`.
- No support for HTTP verbs beyond GET and POST.

## Future improvements

- Keep the custom router, but add a lightweight middleware registry.
- Standardize middleware invocation and parameter parsing.
- Improve route handler consistency without replacing the routing system.
- Retain current route declarations while incrementally removing hardcoded paths.
