# Module Standards

## Naming conventions

- Module names use PascalCase directories under `app/Modules`.
- Controllers use `Controller` or plural `Controllers` suffix consistently.
- Repository classes use `Repository` suffix.
- Service classes use `Service` suffix.
- Validation classes use `Validator` suffix.
- DTOs use descriptive names and `DTO` suffix.

## Module structure

Each module should follow this layout:

- `Controllers/`
- `Repositories/`
- `Services/`
- `Validation/`
- `DTO/`
- `Views/`

## Repository rules

- Repositories encapsulate direct PDO queries and CRUD operations.
- Keep SQL in repository layer only.
- Return arrays or structured DTOs, not raw database resources.
- Avoid embedding view or response logic in repositories.

## Service rules

- Services coordinate business operations and repository actions.
- Use services for cross-entity flows and non-trivial use cases.
- Avoid duplicate service methods that are not used by controllers.

## Validation rules

- Validation belongs to validation classes or a shared validator subsystem.
- Keep validation rules centralized per module.
- Return structured error arrays and do not mix view rendering into validation.

## Controller rules

- Controllers receive request input and route parameters.
- Controllers call validation, service, or repository layers.
- Controllers handle flash messages and redirect/render flows.
- Keep controller actions focused and avoid heavy business logic.

## Routing rules

- Define routes in `routes/web.php`.
- Use explicit route handlers and middleware declarations.
- Keep route definitions simple and stable.
- Route parameters use `{param}` syntax.
