# MODULE_STANDARDS.md

## Approved Lightweight Patterns

### InputMapper

Approved lightweight normalization pattern.

Purpose:
- normalize Excel-pasted input
- normalize UTF-8
- normalize numeric fields
- normalize names and emails

Flow:

Request
→ InputMapper
→ Validator
→ Repository

Do NOT turn InputMapper into framework infrastructure.

## Contractors

Contractors module is canonical implementation reference.