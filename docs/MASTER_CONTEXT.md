# Master Context for Transport ERP v3

## What this project is

Transport ERP v3 is a custom modular transport/logistics ERP platform built for shared hosting. It uses PHP 8.4, PDO + MySQL, and a custom lightweight MVC-like core. It is not a framework, not a demo, and not a SPA.

## Primary AI onboarding

- `docs/MASTER_CONTEXT.md` is the authoritative AI onboarding, runtime truth, and stabilization truth layer.
- Use this file first for architecture, active conventions, current status, and safe project direction.

## Current runtime snapshot

- auth working
- contractors working
- routing stable
- middleware stable
- database stable
- deploy workflow stable
- hybrid views architecture exists intentionally
- Auth normalization postponed
- CSRF incomplete
- production hardening incomplete

## Current architecture

- Lightweight modular monolith.
- Core framework pieces in `app/Core`.
- Modules under `app/Modules` with controllers, repositories, services, validation, DTOs, and views.
- **Transitional hybrid views**: Contractors uses `app/Views/contractors/`, Auth uses `app/Modules/Auth/Views/` with compatibility layer.
- Routing is custom and defined in `routes/web.php` using `App\Core\Routing\Router`.
- Database access is direct PDO with prepared statements.
- Public entry point is `public/index.php` and the application is served under `/v3/public`.

## Active conventions

### Active view standard

- **Transitional hybrid state**: Contractors module uses centralized views in `app/Views/contractors/`. Auth module uses module-local views in `app/Modules/Auth/Views/`, with compatibility layer in `app/Views/Modules/Auth/Views/`. Full normalization postponed after stabilization-phase-1.

### Active controller naming

- Active controller file: `ContractorsController.php`.
- Legacy duplicate naming: `ContractorController.php` removed during stabilization.

### Controllers

Controllers are responsible for:
- request handling,
- validation orchestration,
- service/repository calls,
- deciding redirects and view rendering.

Controllers should stay thin and avoid embedding business or database logic.

### Repositories

Repositories should handle database access only, including:
- CRUD operations,
- pagination,
- soft delete,
- query building for module data.

Repositories must use PDO prepared statements consistently.

### Services

Services should contain business logic and workflow orchestration. They coordinate repositories and do not contain raw SQL.

### Validation

Validation should remain centralized and reusable. Module validators should collect errors and keep rules separate from controller rendering.

## Current module status

### Stable module

- Contractors is the current stable active module.
- Contractors is the canonical implementation reference for new modules.
- Auth module remains transitional with legacy/runtime compatibility patterns and should not be treated as a normalization reference.

### Implemented features

- CRUD for contractors.
- Backend pagination.
- Search.
- RBAC and auth.
- Soft delete.

### Contractor fields

- id
- name
- inn
- contact1_phone
- contact1_email
- legal_address
- status

## Security status

### Implemented

- Session-based auth.
- RBAC permission checks.
- PDO prepared statements.
- Output escaping helper `e()`.

### Currently improving

- CSRF protection.
- Exception handling.
- Session hardening.

## UI philosophy

- Desktop-first ERP interface.
- Operational and task-focused.

## Stabilization Status

- **Phase-1 completed**: Runtime fully functional (auth, routing, middleware, contractors CRUD, database, deploy workflow).
- **Runtime-first strategy**: Prioritized working system over ideal architecture.
- **Compatibility layer**: Added for Auth views to maintain runtime without refactoring.
- **Postponed normalization**: Auth module views not yet centralized to avoid instability.
- **Current deploy workflow**: Functional with git-based deployment and environment config.

### Avoid

- Giant Bootstrap templates.
- Random admin themes.
- Excessive animations.
- Inconsistent spacing.
- Inline styling chaos.

## Technical boundaries

This project must remain:
- lightweight,
- modular,
- maintainable,
- ERP-oriented,
- shared-hosting friendly.

### Do not

- rewrite to Laravel,
- introduce Symfony,
- introduce ORM,
- replace the custom router,
- introduce microservices,
- introduce SPA frontend architecture,
- overengineer abstractions.

### Preferred direction

- incremental stabilization,
- consistency,
- preserve existing routes,
- preserve the existing DB schema,
- preserve current working behavior.

## Technical debt summary

Real current debt includes:
- hardcoded `/v3/public` path handling,
- partial dependency injection absence,
- mixed legacy and new architecture patterns,
- limited middleware pipeline,
- manual schema management,
- duplicate controller naming.

## Development workflow expectations

### AI role

- Focus on architecture, planning, standards, system direction, and ERP logic.
- Analyze before modifying.
- Keep changes small and safe.
- Preserve compatibility and existing flows.

### Codex/Copilot role

- Assist with CRUD generation, repetitive code, scaffolding, and refactors.
- Support multi-file changes within current architecture.

### Human developer role

- Make final architecture decisions.
- Review AI changes and control business logic.
- Validate stability on real ERP workflows.

## AI decision hierarchy

1. Preserve runtime
2. Preserve deployability
3. Preserve compatibility
4. Improve consistency carefully
5. Improve architecture incrementally
6. Avoid risky normalization

## Primary AI entry point

This file is the primary onboarding context for future assistants. It summarizes the project identity, architecture, active conventions, technical direction, boundaries, and priorities.
