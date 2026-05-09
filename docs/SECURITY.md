# Security

## Current security posture

- Security is stabilization/development level, not fully production hardened.
- Runtime security improvements are incremental and must preserve working behavior.

## Currently implemented security

- Prepared statements are used throughout repositories and auth SQL.
- Output escaping helper `e()` is available for view templates.
- Session-based authentication is implemented in `App\Core\Auth\Auth`.
- RBAC permission checks exist through `PermissionMiddleware`.
- CSRF protection for POST routes is enforced via `CsrfMiddleware`.
- Soft delete prevents immediate data removal from contractor listing.

## Auth

- `Auth::attempt()` validates credentials and stores `user_id` in `$_SESSION`.
- `Auth::check()`, `Auth::id()`, and `Auth::user()` provide session-based user state.
- `Auth::can()` runs a permission query using joined role and permission tables.

## RBAC

- Permissions are checked in middleware before route handlers.
- Current contractor permissions: `contractors.view`, `contractors.create`, `contractors.edit`.
- Auth middleware redirects unauthenticated users to login.

## Sessions

- Session state is managed through native PHP sessions.
- Login state is represented by `$_SESSION['user_id']`.
- Session ID is regenerated on successful login.
- Session cookie uses `httponly` and `samesite=Lax` (`secure` when HTTPS is on).
- Logout removes the user session identifier.

## CSRF

- CSRF token helpers exist in `app/Core/Support/helpers.php` (`csrf_token()`, `csrf_field()`, `csrf_verify()`).
- POST forms include `_token` hidden field via `csrf_field()`.
- POST routes are protected by `App\Core\Middleware\CsrfMiddleware`.

## Output escaping

- `app/Core/Support/helpers.php` provides `e()` for safe HTML output.
- Views should use this helper to avoid XSS in rendered templates.

## Prepared statements

- SQL interactions use `PDO::prepare()` and parameter binding.
- Query parameters are passed safely through prepared statements.

## Exception handling

- `App\Core\Exceptions\ExceptionHandler` registers a global handler.
- In `APP_DEBUG=true`, handler shows trace details for debugging.
- In non-debug mode, handler returns `500 Internal Server Error` without trace output.

## Current weaknesses

- Hardcoded redirects and path assumptions increase security risk in deployment.
- `/db-test` route still exists and should remain non-public in production environments.
- Authorization relies on static auth methods and direct middleware instantiation.

## Future improvements

- Continue hardening session settings (timeouts, rotation strategy, secure deployment defaults).
- Replace plain `500` text with a dedicated safe error view.
- Continue using prepared statements and output escaping.
- Keep the existing auth/RBAC approach while improving security practices incrementally.
