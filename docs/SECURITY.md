# Security

## Currently implemented security

- Prepared statements are used throughout repositories and auth SQL.
- Output escaping helper `e()` is available for view templates.
- Session-based authentication is implemented in `App\Core\Auth\Auth`.
- RBAC permission checks exist through `PermissionMiddleware`.
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
- Logout removes the user session identifier.

## CSRF

- CSRF protection is currently not fully enforced across all forms.
- The project status notes that CSRF protection has started as a planned improvement.

## Output escaping

- `app/Core/Support/helpers.php` provides `e()` for safe HTML output.
- Views should use this helper to avoid XSS in rendered templates.

## Prepared statements

- SQL interactions use `PDO::prepare()` and parameter binding.
- Query parameters are passed safely through prepared statements.

## Exception handling

- `App\Core\Exceptions\ExceptionHandler` registers a global handler.
- The current handler logs errors and outputs trace details.
- This behavior is useful for early development but not safe for production.

## Current weaknesses

- Hardcoded redirects and path assumptions increase security risk in deployment.
- Session handling does not show session regeneration or secure cookie flags.
- Exception handler reveals stack traces to users.
- No consistent CSRF token implementation documented in active code.
- Authorization relies on static auth methods and direct middleware instantiation.

## Future improvements

- Introduce consistent CSRF protection for POST forms.
- Add secure session management and session regeneration after login.
- Harden exception handling for production with safe error pages.
- Continue using prepared statements and output escaping.
- Keep the existing auth/RBAC approach while improving security practices incrementally.
