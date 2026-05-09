# Technical Debt

This document records real current technical debt and unstable architecture areas.

## Current technical debt

- Hardcoded `/v3/public` paths in router dispatch and controller redirects.
- Weak or absent dependency injection: many classes instantiate dependencies directly.
- Inconsistent service usage: services exist but are not used consistently by controllers.
- Mixed legacy and new patterns across modules and core code.
- Limited middleware pipeline and no centralized middleware registry.
- Limited abstractions in request handling, routing, and module boundaries.
- Request object is minimal and does not abstract input/source separation.
- No route groups or route organization beyond `routes/web.php`.
- Manual schema and migration management is currently implicit.
- **Transitional hybrid views architecture**: Auth module uses module-local views (`app/Modules/Auth/Views/`) with compatibility layer (`app/Views/Modules/Auth/Views/`), Contractors uses centralized (`app/Views/contractors/`). Full normalization postponed.
- **Postponed Auth normalization**: Auth module architecture not yet aligned with Contractors to avoid runtime instability during stabilization-phase-1.

## Brutally honest notes

- The architecture is real but unfinished; it is a foundation stage rather than a polished framework.
- Current code contains duplicate patterns and implementation debt that should be stabilized.
- The system is functional, but many improvements must be incremental and non-disruptive.
- **Stabilization-phase-1 completed**: Runtime works (auth, routing, middleware, contractors, database, deploy). Known debt includes hybrid views and postponed Auth normalization. Compatibility layer exists for runtime-first strategy.
