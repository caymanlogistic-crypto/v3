# AI Context Rules

## Primary behavior

- This file is the primary AI guidance source for the project.
- Use it for architecture preservation, safe refactoring, and stability decisions.
- Keep the project practical, lightweight, and ERP-focused.

## AI must

- Preserve the existing lightweight modular architecture.
- Preserve current route behavior and route definitions.
- Preserve the current database schema and PDO persistence layer.
- Preserve active conventions such as `app/Views/{module}/` and `ContractorsController.php`.
- Prefer incremental changes over broad rewrites.
- Avoid overengineering and unnecessary complexity.
- Document technical debt honestly and accurately.
- Use PHP 8.4 as the target runtime.
- Follow the modular structure in `app/Core` and `app/Modules`.

## AI must NOT

- Rewrite the project into Laravel.
- Introduce Symfony or other heavy frameworks.
- Introduce SPA frontend architecture or React/Vue rewrites.
- Create fake abstractions or invented systems.
- Replace working router, repository, or modular conventions unnecessarily.
- Introduce microservices, event sourcing, DDD complexity, or ORM migration.

## Safe refactor philosophy

- Analyze the existing code and architecture before modifying.
- Preserve compatibility with current flows and module behavior.
- Prefer small safe refactors and targeted documentation updates.
- Avoid destructive rewrites and keep existing functionality intact.
- Keep controller actions thin and database logic in repositories.

## Operational reminders

- Active views are in `app/Views/{module}/`.
- Legacy module-local views under `app/Modules/{Module}/Views/` are deprecated.
- The current active controller naming is `ContractorsController.php`.
- `ContractorController.php` is legacy/duplicate and should not be used for new runtime behavior.
