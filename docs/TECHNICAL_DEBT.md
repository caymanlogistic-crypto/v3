# Technical Debt

This document records real current technical debt and unstable architecture areas.

## Current technical debt

- Hardcoded `/v3/public` paths in router dispatch and controller redirects.
- Weak or absent dependency injection: many classes instantiate dependencies directly.
- Duplicate controller naming: `ContractorController.php` and `ContractorsController.php` conflict.
- Inconsistent service usage: services exist but are not used consistently by controllers.
- Mixed legacy and new patterns across modules and core code.
- Limited middleware pipeline and no centralized middleware registry.
- Limited abstractions in request handling, routing, and module boundaries.
- Request object is minimal and does not abstract input/source separation.
- No route groups or route organization beyond `routes/web.php`.
- Manual schema and migration management is currently implicit.

## Brutally honest notes

- The architecture is real but unfinished; it is a foundation stage rather than a polished framework.
- Current code contains duplicate patterns and implementation debt that should be stabilized.
- The system is functional, but many improvements must be incremental and non-disruptive.
