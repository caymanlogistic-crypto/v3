# Copilot Instructions — Transport ERP v3

## Read before ANY task

Before writing any code, read these files in order:

1. docs/MASTER_CONTEXT.md
2. docs/COPILOT_API_REFERENCE.md
3. docs/MODULE_STANDARDS.md

For architecture questions also read:
- docs/ARCHITECTURE.md
- docs/AI_CONTEXT_RULES.md

For new modules read:
- docs/MODULE_BLUEPRINT.md

---

## Project identity

- Custom lightweight PHP 8.4 ERP for transport/logistics.
- Shared hosting. No Laravel. No Symfony. No ORM. No SPA.
- Stabilization-first phase. Preserve runtime. Preserve compatibility.

---

## CRITICAL: API methods

Read docs/COPILOT_API_REFERENCE.md before using any core class.
Do NOT invent methods. Only use what is listed there.

Key classes: Flash, Response, Auth, Request.

---

## Canonical reference

- Contractors module is the canonical implementation reference.
- Auth module is transitional — do NOT use as reference.
- New modules follow Contractors pattern.

---

## Forbidden

- No Laravel/Symfony rewrites.
- No ORM.
- No auto-wiring or hidden DI.
- No aggressive normalization.
- No moving Auth view files.
- No rewriting Router core.
- No invented Flash/Response/Auth methods.

---

## Architecture rules

- Controllers: thin, request handling, validation, service calls, redirect/render.
- Repositories: PDO only, no business logic.
- Services: business logic, no SQL, no views.
- Views: use fully qualified class names (no `use` statements available).
- Routes: defined in routes/web.php only.

---

## View files rule

Views have no namespace. Always use fully qualified names:
- WRONG:  `Flash::getError()`
- CORRECT: `\App\Core\Session\Flash::getError()`