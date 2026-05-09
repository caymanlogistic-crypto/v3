# AI Context Rules

## AI must

- Preserve the existing lightweight modular architecture.
- Preserve current route behavior and route definitions.
- Preserve the current database schema and PDO persistence layer.
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

## AI workflow

- Analyze the existing code and architecture before changing anything.
- Preserve compatibility with current flows and module behavior.
- Prefer small safe refactors and documentation updates.
- Avoid destructive rewrites and keep existing functionality intact.
