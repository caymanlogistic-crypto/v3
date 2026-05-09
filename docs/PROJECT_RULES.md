# Project Rules

## Forbidden changes

- No Laravel rewrite.
- No Symfony rewrite.
- No ORM migration or replacement of PDO with an ORM.
- No custom router replacement.
- No SPA frontend rewrite (React/Vue/Nuxt/Angular).
- No microservices.
- No unnecessary abstractions or enterprise overengineering.

## Mandatory standards

- Use PHP 8.4 only.
- Preserve the lightweight modular architecture.
- Repositories are for database access only.
- Services handle business logic and orchestration.
- Controllers must stay thin and focused on request handling.
- Keep the core reusable and lightweight.
- Preserve existing route patterns and public paths.
- Preserve existing database schema and incremental schema management.

## Refactoring philosophy

- Stabilization-first: improve consistency before adding new layers.
- Gradual refactoring: fix technical debt incrementally.
- Preserve working functionality and production-like flows.
- Avoid breaking current module behavior when stabilizing architecture.
- Document real limitations and do not hide technical debt.
