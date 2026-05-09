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

## Canonical controller example

Use the current Contractors module conventions as the implementation pattern.

```php
class DriversController
{
    public function store()
    {
        $input = $_POST;
        $validator = new DriverValidator();
        $errors = $validator->validate($input);

        if (! empty($errors)) {
            return $this->view('drivers/create', [
                'data' => $input,
                'errors' => $errors,
            ]);
        }

        $service = new DriverService(new DriverRepository());
        $service->create($input);

        Response::redirect('/drivers');
    }
}
```

Controllers should:

- orchestrate request handling, validation, service calls, and response flow
- remain operationally readable
- avoid raw SQL and business calculations
- avoid large validation blocks
- use manual instantiation when needed during stabilization
- not require automatic dependency injection

## Canonical repository example

```php
class DriverRepository
{
    public function find(int $id): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM drivers WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: [];
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO drivers (name, license_number) VALUES (:name, :license_number)'
        );
        $stmt->execute([
            'name' => $data['name'],
            'license_number' => $data['license_number'],
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE drivers SET name = :name, license_number = :license_number WHERE id = :id'
        );
        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'license_number' => $data['license_number'],
        ]);
    }
}
```

Repositories should:

- remain explicit, debuggable, and predictable
- use clear SQL and PDO binding
- avoid ORM behavior and hidden query abstractions
- avoid ActiveRecord-style patterns and generic overengineering

## Canonical service example

```php
class DriverService
{
    public function __construct(
        private DriverRepository $repository
    ) {
    }

    public function create(array $data): int
    {
        return $this->repository->create([
            'name' => $data['name'],
            'license_number' => $data['license_number'],
        ]);
    }
}
```

Services should:

- coordinate business operations
- invoke repositories and validation results
- keep business logic readable and contained
- avoid framework infrastructure and hidden dependency magic

## Thin controller definition

A thin controller in this ERP means:

- orchestration over implementation
- request parsing, validation orchestration, service call, and redirect/render flow
- low business logic density
- no SQL, no raw persistence, no large validation blocks
- readability and predictable flow are more important than line-count rules

## Avoid overengineering

Useful abstraction:

- reduces duplication
- improves readability
- preserves runtime predictability

Overengineering:

- introduces homemade framework infrastructure
- adds indirection without operational value
- hides runtime behavior
- complicates debugging

## Current implementation reference

- The Contractors module is the canonical reference implementation for new modules.
- Auth module still contains transitional legacy/runtime compatibility patterns and should not be treated as a normalization reference.
- Direct superglobal request handling remains acceptable during current stabilization.
- Full Request abstraction standardization is postponed.

## Request handling clarification

- Direct access to `$_POST`, `$_GET`, and `$_SESSION` is acceptable in this phase.
- Do not introduce automatic request injection, controller auto-wiring, or hidden dependency resolution.
- Manual instantiation remains operationally correct for controllers and services.

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
