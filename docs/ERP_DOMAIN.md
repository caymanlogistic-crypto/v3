# ERP Domain

## Real ERP direction

This platform is a transport/logistics ERP focused on operational workflows for contractors, drivers, vehicles, trips, orders, and related business domains.

## Implemented domain

- Contractors: current active module with list, create, edit, update, search, pagination, soft delete.
- Auth and RBAC: session-based authentication and permission checks for module access.
- Core custom routing, controllers, repositories, services, validation, and views.

## Planned domain

- Orders: manage transportation orders, status tracking, pricing, and shipment lifecycle.
- Trips: operational trip planning, assignment, scheduling, and completion tracking.
- Drivers: driver profiles, licenses, availability, assignments, and performance.
- Fleet: vehicle groupings, maintenance cycles, capacity, and utilization.
- Vehicles: vehicle inventory, registration, VIN, and active status.
- Logistics: route planning, load optimization, and logistics workflow coordination.
- Tracking: location tracking, status updates, ETA, and shipment progress.
- Warehouse: inventory management, storage locations, inbound/outbound handling.
- Finance: invoicing, payments, cost accounting, and financial reconciliation.
- Documents: contracts, waybills, invoices, and transport documentation.
- Notifications: alerts for workflow events, approvals, and status changes.

## Expected relationships

- Contractors link to orders and documents.
- Drivers are assigned to trips and vehicles.
- Vehicles participate in fleet and trip planning.
- Orders generate trips and involve carriers, drivers, and equipment.
- Warehouse and logistics coordinate physical flow and inventory.
- Finance tracks costs, payments, and document-related billing.
- Permissions control access to module actions and operational screens.

## Operational workflows

- Business users work in desktop-first ERP screens.
- The system should support dense operational interfaces for fast workflow.
- Status-driven flows guide record progression through planned states.
- Permissions determine what users can view and edit.

## ERP philosophy

- Lightweight and modular, not a framework clone.
- Real business focus: transport, logistics, and back-office operations.
- Support shared hosting and PHP 8.4 compatibility.
- Evolve the platform with practical modules rather than broad architecture rewrites.
