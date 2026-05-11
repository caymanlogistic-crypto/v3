# MODULE STANDARDS

## Общие правила модулей
- Controller -> Service -> Repository
- PDO prepared statements
- no framework abstractions
- no invented helpers

## File subsystem standard
Каждый модуль (Contractors/Drivers/Vehicles) использует:
- Controller
- Service
- Repository
- Validator
- Storage
- edit-view upload blocks
- download/delete через controller routes

## Upload behavior standard
- multiple files в input
- grouped submit
- per-file validation (20MB limit)
- file_type сохраняется на каждую запись
- predefined blocks скрываются после загрузки
- `other` не скрывается

## Required field standard (runtime)
См. `docs/MASTER_CONTEXT.md` как source of truth.
