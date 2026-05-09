# Architecture

## Current architecture style

- Lightweight modular monolith.
- Custom framework-like core under `app/Core`.
- Modules in `app/Modules` with dedicated controllers, repositories, services, validation, and views.
- Views are rendered from `app/Views` and layouts are applied by `app/Core/View/View.php`.

## Request lifecycle

1. Public entrypoint is `public/index.php`.
2. Bootstrap loads `bootstrap/app.php`, environment variables, autoload, helpers, and session setup.
3. Route definitions from `routes/web.php` are registered in the router.
4. `Router::dispatch()` matches request method and normalized URI.
5. Route middleware executes before controller handlers.
6. The route handler creates a controller instance and calls the requested action.
7. Controller actions use views, repository data, validation, flash messages, and response helpers.

## Routing flow

- `app/Core/Routing/Router.php` stores GET and POST routes.
- URI parameters are defined with `{name}` and extracted with regex.
- Middleware entries may include parameters using `Class:permission` syntax.
- If no route matches, a 404 response is returned.

## Rendering flow

- `App\Core\View\View::render()` converts dot notation to file paths.
- It requires the view file, captures output, and includes the layout file.
- Data is extracted into local variables before view execution.

## Controller / Service / Repository boundaries

- Controllers handle request input, validation, repository/service calls, flash messages, and view responses.
- Services are present, but service layer usage is inconsistent.
- Repositories encapsulate direct PDO queries and CRUD logic.
- Validation is currently handled by module-specific validator classes.

## Module structure

- `app/Modules/<ModuleName>/Controllers`
- `app/Modules/<ModuleName>/Repositories`
- `app/Modules/<ModuleName>/Services`
- `app/Modules/<ModuleName>/Validation`
- `app/Modules/<ModuleName>/DTO`

Active views are stored in `app/Views/{module}/`.
Module-local views under `app/Modules/<ModuleName>/Views` are legacy/deprecated and inactive for current rendering.

## Current architecture limitations

- Strong coupling through manual `new` object creation.
- Global state access via `$_ENV`, `$_SESSION`, `$_GET`, `$_POST`.
- Duplicated base controller logic and inconsistent base classes.
- Many classes are `final`, limiting extension and testing.
- Hardcoded public path and redirect URLs (`/v3/public`).
- Mixed old/new patterns across controller, service, and repository layers.

## Future direction

- Preserve lightweight modular monolith.
- Keep current custom routing and PDO layer.
- Improve consistency of controllers, services, repositories, validation, and policies.
- Incrementally add reusable core abstractions without rewriting working modules.
