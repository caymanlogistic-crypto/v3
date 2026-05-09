# AI Rules

## Forbidden refactors

- Do not rewrite the system into Laravel.
- Do not introduce Symfony or heavy frameworks.
- Do not replace the custom routing system.
- Do not replace the PDO persistence layer.
- Do not convert the codebase into microservices.
- Do not introduce DDD, CQRS, or event sourcing.

## Architectural boundaries

- Preserve the current modular structure under `app/Modules`.
- Keep the platform as a lightweight enterprise modular ERP.
- Retain the custom core in `app/Core`.
- Avoid broad architectural rewrites.

## ERP conventions

- Desktop-first operational UI.
- Compact tables and forms.
- Lightweight CSS and reusable styles.
- Focus on real transport/logistics business use cases.

## Stabilization-first philosophy

- Prioritize stabilization and gradual improvement.
- Fix technical debt incrementally.
- Document real limitations honestly.
- Improve consistency without introducing unnecessary complexity.

## AI behavior expectations

- Document actual implementation, not imagined features.
- Keep changes aligned with current architecture.
- Recommend future improvements separately from current implementation.
- Preserve current working modules.
- Do not invent nonexistent systems or patterns.
