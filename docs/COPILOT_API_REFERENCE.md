# Copilot API Reference

## CRITICAL RULE

Do NOT invent methods. Use ONLY what is listed in this file.
If a method is not listed here — it does not exist. Do not create it.
When in doubt — ask, do not hallucinate.

---

## Flash — App\Core\Session\Flash

```php
Flash::success(string $message): void       // sets flash_success in session
Flash::error(string $message): void         // sets flash_error in session
Flash::getSuccess(): ?string                // reads and clears flash_success
Flash::getError(): ?string                  // reads and clears flash_error
```

**Does NOT have:** `setOld()`, `getOld()`, `setError()`, `set()`, `get()`, `has()`

---

## Response — App\Core\Http\Response

```php
Response::redirect(string $url): void       // redirects and calls exit internally
Response::abort(int $code, string $message): void
Response::json(mixed $data, int $code = 200): void
```

**Note:** `Response::redirect()` calls `exit` — no return needed after it.

---

## Auth — App\Core\Auth\Auth

```php
Auth::attempt(string $email, string $password): bool
Auth::logout(): void
Auth::check(): bool
Auth::id(): ?int
Auth::user(): ?array
Auth::can(string $permission): bool
```

---

## Request — App\Core\Http\Request

```php
$request->input(string $key, mixed $default = null): mixed  // reads POST then GET
$request->all(): array
$request->only(array $keys): array
$request->has(string $key): bool
$request->method(): string
$request->uri(): string
$request->isPost(): bool
$request->isGet(): bool
```

---

## Old Input Pattern

Flash has no `setOld()` or `getOld()`. Use session directly:

```php
// Store old input after failed validation:
$_SESSION['old_email'] = $email;

// Read and clear in controller before rendering view:
$oldEmail = $_SESSION['old_email'] ?? '';
unset($_SESSION['old_email']);

// Pass to view:
$this->view('some/view', ['old' => ['email' => $oldEmail]]);
```

---

## Views — Fully Qualified Class Names

View files have no namespace and no `use` statements.
Always use fully qualified class names in views:

```php
// WRONG:
Flash::getError()

// CORRECT:
\App\Core\Session\Flash::getError()
\App\Core\Session\Flash::getSuccess()
```

---

## How to use this file in Copilot prompts

Add this at the top of every prompt where core classes are involved:

```
Read docs/COPILOT_API_REFERENCE.md before writing any code.
Use ONLY the methods listed there. Do not invent new methods.
```

---

## CSRF Helpers (global)

```php
csrf_token(): string
csrf_field(): string
csrf_verify(?string $token): bool
```

Use `<?= csrf_field() ?>` in all POST forms.
