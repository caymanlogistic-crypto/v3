# AI Rules — Quick Reference

- Use this file for fast operational reminders.
- The primary AI onboarding file is `docs/MASTER_CONTEXT.md`.
- `docs/AI_CONTEXT_RULES.md` is a secondary operational guidance file.

## Core boundaries

- Preserve the lightweight modular ERP architecture.
- Keep PHP 8.4 as the runtime target.
- Keep the custom router and PDO-based DB layer.
- Preserve existing routes, module structure, and DB schema.

## Quick do nots

- No Laravel, Symfony, or heavy framework rewrites.
- No ORM replacement.
- No SPA frontend architecture.
- No microservices or event-sourcing patterns.
- No unnecessary abstractions.

## Quick principles

- Prefer small, safe refactors.
- Stabilize before adding new complexity.
- Keep controllers thin and repositories DB-focused.
- Document real technical debt honestly.
