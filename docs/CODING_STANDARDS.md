# Coding Standards

## PHP style rules

- Use `declare(strict_types=1);` in PHP files.
- Use PSR-4 autoloading with namespaces under `App\`.
- Prefer typed parameters and return types.
- Keep code readable and avoid deep nesting.

## Architecture rules

- Preserve the lightweight modular architecture.
- Keep controllers, services, repositories, validation, and views separate.
- Avoid introducing heavy frameworks or large dependencies.
- Do not rewrite the routing system or PDO persistence layer.

## Typing rules

- Use scalar and return type declarations whenever feasible.
- Avoid loose typing for business logic and database access.
- Keep arrays typed by documenting expected keys in comments or DTOs.

## Naming rules

- Use descriptive class names with clear suffixes: `Controller`, `Repository`, `Service`, `Validator`, `DTO`.
- Keep method names simple and action-focused.
- Keep route names and permission keys consistent.

## Layer responsibilities

- Controllers: request handling, validation invocation, response rendering, flash.
- Services: coordinate business rules and repository operations.
- Repositories: direct database access and query logic.
- Validation: rules and error collection.
- Views: presentation only.

## SOLID direction

- Improve single responsibility gradually.
- Reduce tight coupling by avoiding direct `new` every time when possible.
- Add abstractions carefully when they solve real pain points.
- Do not create unnecessary complexity for the sake of patterns.

## Lightweight philosophy

- Keep code changes incremental.
- Avoid overengineering and unnecessary layers.
- Prefer small reusable core helpers over large frameworks.
- Document real technical debt and fix it gradually.
