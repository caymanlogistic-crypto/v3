# Contractors Module

## Current module structure

- Controllers: `app/Modules/Contractors/Controllers/ContractorsController.php`
- Repositories: `app/Modules/Contractors/Repositories/ContractorRepository.php`
- Services: `app/Modules/Contractors/Services/ContractorService.php`
- Validation: `app/Modules/Contractors/Validation/ContractorValidator.php`
- Views: `app/Views/contractors/*.php`
- DTOs: `app/Modules/Contractors/DTO/` (currently has `CreateContractorDTO.php`)

## Active runtime files

- `routes/web.php` registers contractor routes.
- `ContractorsController` handles list, create, store, edit, update, delete.
- `ContractorRepository` performs CRUD, soft delete, and pagination.
- `ContractorValidator` validates contractor form data.

## CRUD flow

- `GET /contractors` → `ContractorsController::index()` → repository pagination.
- `GET /contractors/create` → `create()` renders form.
- `POST /contractors/store` → `store()` validates input and creates contractor.
- `GET /contractors/{id}/edit` → `edit()` loads contractor and renders edit form.
- `POST /contractors/{id}/update` → `update()` validates and updates contractor.
- `POST /contractors/{id}/delete` → `delete()` performs soft delete.

## Permissions

Current permission keys:

- `contractors.view`
- `contractors.create`
- `contractors.edit`

Middleware on routes enforces authentication and RBAC on contractor views.

## Search

- List page supports search by `name`, `inn`, and `contact1_phone`.
- Search parameter is passed through `ContractorRepository::paginate()`.

## Pagination

- `ContractorRepository::paginate()` counts total records and builds pagination metadata via `App\Core\Pagination\Paginator`.
- Pagination is backend-driven with `LIMIT` and `OFFSET`.

## Soft delete

- `ContractorRepository::softDelete()` sets `deleted_at = NOW()`.
- Listing queries filter `deleted_at IS NULL`.

## Current limitations

- Controller contains direct request extraction and view/redirect logic.
- Service layer exists but is not consistently used.
- CSRF forms/routes are now protected, but the module still relies on manual wiring.
- Hardcoded redirect paths contain `/v3/public`.

## Future improvements

- Stabilize module boundaries: use service layer consistently.
- Centralize validation and request input mapping.
- Remove hardcoded public path values gradually.
- Keep existing route and repository approach while improving consistency.
