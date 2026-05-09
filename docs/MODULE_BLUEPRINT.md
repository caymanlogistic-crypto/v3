# Module Blueprint

## Recommended structure

Use this structure for lightweight modules:

- `app/Modules/Drivers/`
  - `Controllers/`
  - `Repositories/`
  - `Services/`
  - `Validation/`
  - `DTO/`
- Active views: `app/Views/drivers/`

## Controller example responsibilities

Controllers should be thin and responsible for:

- request handling
- validation orchestration
- service calls
- redirects
- rendering

Controllers should not contain raw database SQL or view template logic.

## Repository responsibilities

Repositories handle PDO database access only:

- CRUD operations
- pagination
- search
- soft delete
- query preparation and execution

Do not put business logic or rendering decisions in repositories.

## Service responsibilities

Services handle business workflows and orchestration:

- coordinating repositories
- implementing business rules
- handling cross-entity logic when needed

Services should not render views or execute SQL directly.

## Validation flow

The recommended validation flow is:

1. Request
2. Validator
3. Errors
4. Flash/View
5. Save

Validation should return structured error arrays and keep rules separate from controller rendering.

## CRUD flow

Use this practical flow:

- Form → Controller → Validator → Service → Repository → Redirect/Flash

This ensures controllers remain request-focused and services handle orchestration.

## Route examples

Use route patterns similar to the existing Contractors module:

- `/contractors`
- `/contractors/create`
- `/contractors/store`
- `/contractors/{id}/edit`
- `/contractors/{id}/update`
- `/contractors/{id}/delete`

Route definitions live in `routes/web.php` and use `Router::get()` / `Router::post()`.

## UI expectations

- compact ERP UI
- reusable tables/forms
- desktop-first layout
- operational workflows
- lightweight CSS

Keep UI simple, efficient, and consistent with the existing ERP style.
