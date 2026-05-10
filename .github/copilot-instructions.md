# Copilot Instructions — Transport ERP v3

## MANDATORY: Read before ANY task

Read these files in order before writing any code:

### Primary (always read)
1. `docs/MASTER_CONTEXT.md` — authoritative runtime truth, stabilization status, active conventions
2. `docs/COPILOT_API_REFERENCE.md` — available methods only, do not invent methods
3. `docs/AI_CONTEXT_RULES.md` — what AI must and must not do
4. `docs/AI_RULES.md` — quick reference rules
5. `docs/MODULE_STANDARDS.md` — naming, structure, CRUD flow

### Secondary (read when relevant)
- `docs/ARCHITECTURE.md` — request lifecycle, routing flow, rendering flow
- `docs/CODING_STANDARDS.md` — PHP style, typing, naming rules
- `docs/MODULE_BLUEPRINT.md` — canonical controller/repository/service examples
- `docs/ROUTING.md` — router behavior, middleware, route parameters
- `docs/SECURITY.md` — auth, RBAC, sessions, CSRF status
- `docs/TECHNICAL_DEBT.md` — known debt, do not fix without permission
- `docs/UI_GUIDELINES.md` — ERP UI rules, forbidden UI patterns
- `docs/PROJECT_RULES.md` — forbidden changes, mandatory standards

### Module-specific (read when working on that module)
- `docs/CONTRACTORS_MODULE.md` — contractors CRUD, fields, permissions, search

### Domain reference (read when planning new modules)
- `docs/ERP_DOMAIN.md` — planned modules and relationships
- `docs/ERP_VISION.md` — platform goals and UI philosophy

### Operations (read when deploying or debugging)
- `docs/DEPLOYMENT.md` — shared hosting, git pull, php8.4 commands
- `docs/DEVELOPMENT_WORKFLOW.md` — roles, git workflow, debugging

---

## Project identity

- Custom lightweight PHP 8.4 ERP for transport/logistics.
- Shared hosting. No Laravel. No Symfony. No ORM. No SPA.
- Stabilization-first phase. Preserve runtime. Preserve compatibility.

---

## CRITICAL: API methods

Read `docs/COPILOT_API_REFERENCE.md` before using any core class.
Do NOT invent methods. Only use what is listed there.

Key classes: `Flash`, `Response`, `Auth`, `Request`.

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
- No invented Flash/Response/Auth/Request methods.
- No touching technical debt without explicit instruction.

---

## Architecture rules

- Controllers: thin, request handling, validation, service calls, redirect/render.
- Repositories: PDO only, no business logic.
- Services: business logic, no SQL, no views.
- Views: use fully qualified class names (no `use` statements available).
- Routes: defined in `routes/web.php` only.

---

## View files rule

Views have no namespace. Always use fully qualified names:
```php
// WRONG:
Flash::getError()

// CORRECT:
\App\Core\Session\Flash::getError()
\App\Core\Session\Flash::getSuccess()
```

---

## Old input pattern

No `Flash::setOld()` or `Flash::getOld()` — use session directly:
```php
// Store:
$_SESSION['old_email'] = $email;

// Read and clear:
$oldEmail = $_SESSION['old_email'] ?? '';
unset($_SESSION['old_email']);
```

---

## UI rules

- Desktop-first, compact ERP interface.
- No Bootstrap themes, no random admin templates.
- No excessive animations or inline styling chaos.
- Compact tables and compact forms.
- Consistent spacing and typography.