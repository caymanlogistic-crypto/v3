# TRANSPORT ERP v3

Custom transport/logistics ERP platform built on a lightweight PHP modular core.

## Project overview

- Stack: PHP 8.4, MySQL, PDO, custom MVC-like architecture.
- Structure: lightweight modular monolith with core framework pieces in `app/Core`.
- Public entrypoint: `/v3/public`.
- Current active module: Contractors.

## Architecture summary

- Core components in `app/Core`: Router, Controllers, Repositories, Services, Validation, Auth, RBAC, Middleware, Flash, View rendering, Pagination.
- Modules in `app/Modules`, each module contains its own Controllers, Repositories, Services, Validation, DTO, Views.
- Routes are defined in `routes/web.php` and dispatched by `app/Core/Routing/Router.php`.

## Setup basics

1. Ensure PHP 8.4 is used on the host environment.
2. Install dependencies via Composer: `php8.4 composer.phar install` or `php8.4 /usr/bin/composer install`.
3. Configure environment variables in `.env` at `APP_ROOT`.
4. Use `public/index.php` as the web entry point behind the public path.

## Deployment basics

- Project is designed for shared hosting.
- Keep `app/Core` lightweight and avoid introducing heavy frameworks.
- Use Git deployment and keep documentation updated alongside code.

## Project philosophy

- Stabilization-first: improve consistency and reliability gradually.
- Preserve current modular structure.
- Avoid overengineering and unnecessary complexity.
- Document real technical debt honestly.
