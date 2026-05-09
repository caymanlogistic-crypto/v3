# AI Context Rules

## Primary behavior

- This file is the primary AI guidance source for the project.
- Use it for architecture preservation, safe refactoring, and stability decisions.
- Keep the project practical, lightweight, and ERP-focused.

## AI must

- Preserve the existing lightweight modular architecture.
- Preserve current route behavior and route definitions.
- Preserve the current database schema and PDO persistence layer.
- Preserve active conventions: centralized views for Contractors (`app/Views/contractors/`), module-local for Auth (`app/Modules/Auth/Views/`) with compatibility layer.
- Prefer incremental changes over broad rewrites.
- Avoid overengineering and unnecessary complexity.
- Document technical debt honestly and accurately.
- Use PHP 8.4 as the target runtime.
- Follow the modular structure in `app/Core` and `app/Modules`.
- **Do NOT normalize Auth views yet**: Respect postponed normalization to preserve runtime stability.

## AI must NOT

- Rewrite the project into Laravel.
- Introduce Symfony or other heavy frameworks.
- Introduce SPA frontend architecture or React/Vue rewrites.
- Create fake abstractions or invented systems.
- Replace working router, repository, or modular conventions unnecessarily.
- Introduce microservices, event sourcing, DDD complexity, or ORM migration.
- **Normalize Auth views prematurely**: Auth uses module-local with compatibility layer; do not move files or refactor without explicit permission.

## Safe refactor philosophy

- Analyze the existing code and architecture before modifying.
- Preserve compatibility with current flows and module behavior.
- Prefer small safe refactors and targeted documentation updates.
- Avoid destructive rewrites and keep existing functionality intact.
- Keep controller actions thin and database logic in repositories.

## Operational reminders

- **Transitional views**: Contractors in `app/Views/contractors/`, Auth in `app/Modules/Auth/Views/` with compatibility layer.
- Legacy module-local views are deprecated except for Auth (transitional).
- The current active controller naming is `ContractorsController.php`.
- `ContractorController.php` was removed during stabilization.
- **Stabilization-phase-1 completed**: Runtime works; do not break it with premature normalization.
