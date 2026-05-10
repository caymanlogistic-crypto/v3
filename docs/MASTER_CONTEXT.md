# Master Context for Transport ERP v3

## What this project is

Transport ERP v3 is a custom modular transport/logistics ERP platform built for shared hosting. It uses PHP 8.4, PDO + MySQL, and a custom lightweight MVC-like core. It is not a framework, not a demo, and not a SPA.

## Primary AI onboarding

- `docs/MASTER_CONTEXT.md` is the authoritative AI onboarding, runtime truth, and stabilization truth layer.
- Use this file first for architecture, active conventions, current status, and safe project direction.

## Current runtime snapshot

- auth working and hardened (is_active check, session destroy, flash, email preservation)
- contractors working (CRUD, pagination, search, soft delete)
- routing stable (Request import fixed, middleware parsing fixed)
- middleware stable (AuthMiddleware, PermissionMiddleware both working correctly)
- database stable
- deploy workflow stable (git-based)
- hybrid views architecture exists intentionally
- Auth normalization postponed
- CSRF implemented on POST routes via CsrfMiddleware
- production hardening incomplete (exception handler still dev-mode)
- contractors forms incomplete — missing 13 DB fields in controller/service/repository/views

## Current architecture

- Lightweight modular monolith.
- Core framework pieces in `app/Core`.
- Modules under `app/Modules` with controllers, repositories, services, validation, DTOs, and views.
- **Transitional hybrid views**: Contractors uses `app/Views/contractors/`, Auth uses `app/Modules/Auth/Views/` with compatibility layer at `app/Views/Modules/Auth/Views/`.
- Routing is custom and defined in `routes/web.php` using `App\Core\Routing\Router`.
- Database access is direct PDO with prepared statements.
- Public entry point is `public/index.php` and the application is served under `/v3/public`.

## Active conventions

### Active view standard

- **Transitional hybrid state**: Contractors module uses centralized views in `app/Views/contractors/`. Auth module uses module-local views in `app/Modules/Auth/Views/`, with compatibility layer in `app/Views/Modules/Auth/Views/`. Full normalization postponed after stabilization-phase-1.
- **View files have no namespace** — always use fully qualified class names: `\App\Core\Session\Flash::getError()` not `Flash::getError()`.

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

### Stable modules

- **Auth** — fully working. Login, logout, session hardened. RBAC working.
- **Contractors** — CRUD working. Forms incomplete: missing 13 DB fields.

### Contractors fields status

Currently handled in controller/service/repository/views:
- name, inn, contact1_phone, contact1_email, legal_address, status

Missing from controller/service/repository/views (next task):
- kpp, ogrn, okved
- director, director_post
- contact1_name
- contact2_name, contact2_phone, contact2_email
- bank_name, bank_account, bank_corr_account, bank_bik
- comments

System fields (never in forms):
- id, logist_id, created_at, updated_at, deleted_at, deleted_by, updated_by

### Implemented features

- CRUD for contractors (partial fields).
- Backend pagination.
- Search by name, inn, contact1_phone.
- RBAC and auth.
- Soft delete.
- Flash messages via layout.
- CSRF on all POST routes.

## Security status

### Implemented

- Session-based auth with is_active + deleted_at checks.
- Proper session destruction on logout.
- RBAC permission checks via PermissionMiddleware.
- PDO prepared statements.
- Output escaping helper `e()`.
- CSRF middleware on POST routes.
- Flash::error() on failed login with email preservation.

### Still incomplete

- Exception handler reveals stack traces (dev mode only).
- Production hardening incomplete.
- logist_id assignment not yet implemented.

## Core classes — available methods

### Flash — App\Core\Session\Flash
- `Flash::success(string $message): void`
- `Flash::error(string $message): void`
- `Flash::getSuccess(): ?string`
- `Flash::getError(): ?string`
- **No other methods exist.**

### Response — App\Core\Http\Response
- `Response::redirect(string $url): void` — calls exit internally
- `Response::abort(int $code, string $message): void`
- `Response::json(mixed $data, int $code = 200): void`

### Auth — App\Core\Auth\Auth
- `Auth::attempt(string $email, string $password): bool`
- `Auth::logout(): void`
- `Auth::check(): bool`
- `Auth::id(): ?int`
- `Auth::user(): ?array`
- `Auth::can(string $permission): bool`

### Request — App\Core\Http\Request
- `$request->input(string $key, mixed $default = null): mixed`
- `$request->all(): array`
- `$request->only(array $keys): array`
- `$request->has(string $key): bool`
- `$request->method(): string`
- `$request->uri(): string`
- `$request->isPost(): bool`
- `$request->isGet(): bool`

## UI philosophy

- Desktop-first ERP interface.
- Operational and task-focused.
- Compact tables and compact forms.
- No Bootstrap themes, no random admin templates.
- Flash messages handled globally in layout.

## Stabilization status

- **Phase-1 completed**: Runtime fully functional (auth, routing, middleware, contractors CRUD, database, deploy workflow).
- **Phase-2 in progress**: Contractors form completion (all DB fields), consistency improvements.
- **Runtime-first strategy**: Prioritized working system over ideal architecture.
- **Compatibility layer**: Added for Auth views to maintain runtime without refactoring.
- **Postponed normalization**: Auth module views not yet centralized.
- **CSRF**: Implemented on all POST routes.
- **Copilot context system**: `.github/copilot-instructions.md` auto-loads project context. `docs/COPILOT_API_REFERENCE.md` prevents method hallucination.

## Active routes

- `GET /login` — AuthController::login
- `POST /login` — AuthController::attempt + CsrfMiddleware
- `POST /logout` — AuthController::logout + AuthMiddleware + CsrfMiddleware
- `GET /contractors` — index + AuthMiddleware + PermissionMiddleware:contractors.view
- `GET /contractors/create` — create + AuthMiddleware + PermissionMiddleware:contractors.create
- `POST /contractors/store` — store + AuthMiddleware + CsrfMiddleware + PermissionMiddleware:contractors.create
- `GET /contractors/{id}/edit` — edit + AuthMiddleware + PermissionMiddleware:contractors.edit
- `POST /contractors/{id}/update` — update + AuthMiddleware + CsrfMiddleware + PermissionMiddleware:contractors.edit
- `POST /contractors/{id}/delete` — delete + AuthMiddleware + CsrfMiddleware + PermissionMiddleware:contractors.edit

## Technical boundaries

This project must remain:
- lightweight, modular, maintainable, ERP-oriented, shared-hosting friendly.

### Do not

- rewrite to Laravel, introduce Symfony, introduce ORM,
- replace the custom router, introduce microservices,
- introduce SPA frontend architecture, overengineer abstractions.

### Preferred direction

- incremental stabilization, consistency,
- preserve existing routes, preserve the existing DB schema,
- preserve current working behavior.

## Technical debt summary

- Hardcoded `/v3/public` paths mostly fixed; may remain in some places.
- Partial dependency injection absence — manual `new` used intentionally.
- Mixed legacy and new patterns across modules.
- Exception handler dev-mode only — production hardening postponed.
- logist_id business logic not yet implemented.
- Contractors forms missing 13 DB fields — next active task.
- Auth view normalization postponed intentionally.

## Development workflow

### AI toolchain

**Claude** (this session):
- Deep reviewer, edge-case analyst, ambiguity detector
- Architect coordinator — plans tasks, generates Copilot prompts
- Risk analyst — reviews Copilot output before commit
- Hotfix generator — fixes Copilot hallucinations

**GitHub Copilot**:
- Primary implementation engine
- Reads project context automatically via `.github/copilot-instructions.md`
- Requires explicit `AVAILABLE METHODS` block to prevent hallucinations
- Must be reviewed by Claude before committing

**ChatGPT**:
- Chief architect, stabilization advisor
- Complex reasoning, ERP planning, documentation governance

**Local Codex**:
- Heavy refactor specialist, batch transformations, multi-file operations

**Git/GitHub**:
- Source of truth
- Workflow: local → commit → push → server git pull → verify

### Copilot hallucination prevention

- `docs/COPILOT_API_REFERENCE.md` — canonical method list
- `.github/copilot-instructions.md` — auto-loaded in every Copilot Chat
- Claude reviews all Copilot output before commit
- Always verify methods exist before applying Copilot changes

### Human developer role

- Makes final architecture decisions
- Reviews AI changes
- Validates stability on real ERP workflows
- Applies commits after Claude review

## AI decision hierarchy

1. Preserve runtime
2. Preserve deployability
3. Preserve compatibility
4. Improve consistency carefully
5. Improve architecture incrementally
6. Avoid risky normalization

## Primary AI entry point

This file is the primary onboarding context for all AI assistants. Read it first before any task.
