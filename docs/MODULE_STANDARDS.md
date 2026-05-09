# Module Standards

## Naming conventions

- Module names use PascalCase directories under `app/Modules`.
- Controller files use the plural suffix `Controllers` when active: e.g. `ContractorsController.php`.
- Avoid legacy duplicate filenames like `ContractorController.php`.
- Repository classes use `Repository` suffix.
- Service classes use `Service` suffix.
- Validation classes use `Validator` suffix.
- DTOs use descriptive names and `DTO` suffix.

## Active module structure

Each module should follow this layout:

- `Controllers/`
- `Repositories/`
- `Services/`
- `Validation/`
- `DTO/`

**Transitional views standard**:
- Contractors: centralized in `app/Views/contractors/`.
- Auth: module-local in `app/Modules/Auth/Views/`, with compatibility layer in `app/Views/Modules/Auth/Views/`.
- Future: normalize all modules to centralized views.

## Real module example: Contractors

- Controller: `app/Modules/Contractors/Controllers/ContractorsController.php`
- Repository: `app/Modules/Contractors/Repositories/ContractorRepository.php`
- Service: `app/Modules/Contractors/Services/ContractorService.php`
- Validator: `app/Modules/Contractors/Validation/ContractorValidator.php`
- Active views: `app/Views/contractors/*.php`

## Transitional module example: Auth

- Controller: `app/Modules/Auth/Controllers/AuthController.php`
- Views: `app/Modules/Auth/Views/login.php` (module-local, with compatibility layer at `app/Views/Modules/Auth/Views/login.php`)
- Future: normalize to centralized views.

## Recommended CRUD flow

- Form → Controller → Validator → Service → Repository → Redirect/Flash

### Example route flow

- `GET /contractors`
- `GET /contractors/create`
- `POST /contractors/store`
- `GET /contractors/{id}/edit`
- `POST /contractors/{id}/update`
- `POST /contractors/{id}/delete`

## Validation flow

- Controller collects request input.
- Controller calls module validator.
- Validator returns structured error arrays.
- Controller renders the view with errors or proceeds to save.

## Repository responsibilities

- PDO queries only.
- CRUD operations.
- Pagination and search.
- Soft delete.
- No business logic or rendering.

## Service responsibilities

- Business workflows and orchestration.
- Cross-entity coordination when needed.
- No view rendering or SQL.

## Controller responsibilities

- Request handling and input mapping.
- Validation orchestration.
- Service or repository calls.
- Redirects, flash messages, and rendering.
- Keep controllers thin.

## Routing rules

- Define routes in `routes/web.php`.
- Use explicit route handlers with middleware declarations.
- Keep route definitions stable and readable.
- Route parameters use `{param}` syntax.
