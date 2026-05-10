# Technical Debt

This document records real current technical debt and unstable architecture areas.
Use `docs/MASTER_CONTEXT.md` as the authoritative runtime and stabilization truth document.

## Resolved debt (this session)

- ✅ Hardcoded `/v3/public` paths in contractor views — fixed
- ✅ Hardcoded `/v3/public` in login views — fixed
- ✅ PermissionMiddleware not parsing 'Class:permission' string — fixed
- ✅ Auth::attempt() not checking is_active and deleted_at — fixed
- ✅ Auth::logout() not destroying session properly — fixed
- ✅ AuthController login failure using echo instead of Flash — fixed
- ✅ Router.php missing Request namespace import — fixed
- ✅ Flash message not displayed in contractor views — confirmed handled by layout
- ✅ create.php status field not preserved on validation error — fixed
- ✅ Copilot hallucination risk — mitigated via COPILOT_API_REFERENCE.md and copilot-instructions.md

## Current active debt

### High priority
- **Contractors forms incomplete**: controller, service, repository, and views handle only 6 of 19 DB fields. Missing: kpp, ogrn, okved, director, director_post, contact1_name, contact2_name, contact2_phone, contact2_email, bank_name, bank_account, bank_corr_account, bank_bik, comments. (Next active task)

### Medium priority
- **Exception handler dev-mode**: reveals stack traces to users. Not safe for production.
- **logist_id not implemented**: business logic for assigning contractors to logists postponed.
- **Auth view normalization postponed**: Auth module uses module-local views with compatibility layer. Not yet aligned with Contractors pattern.
- **ContractorValidator incomplete**: only validates name, inn, contact1_email, status. Missing format validation for phone, kpp, ogrn, bank fields.
- **user() in Auth.php**: does not check is_active or deleted_at when loading current user from session.

### Low priority
- **Hardcoded `/v3/public`**: may remain in some files not yet audited.
- **Manual schema management**: no migration system, schema changes applied manually.
- **No route groups**: all routes flat in routes/web.php.
- **Limited middleware pipeline**: no centralized middleware registry.
- **Weak dependency injection**: manual `new` throughout — intentional during stabilization.
- **Mixed legacy/new patterns**: some modules still use older conventions.

## Brutally honest notes

- The architecture is real but unfinished — foundation stage, not polished framework.
- Copilot requires explicit method reference to avoid hallucinations — this is a known toolchain limitation now documented and mitigated.
- Auth module is functional and hardened but architecturally transitional.
- Contractors is the canonical reference but its forms are currently incomplete.
- System is functional and deployable — debt is documented, not hidden.
