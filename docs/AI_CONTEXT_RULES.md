# AI_CONTEXT_RULES.md

## Current Operational Direction

The project is now in operational ERP stabilization.

Architecture decisions are driven by:
- logistics workflow
- runtime stability
- operational UX

## Contractors

Implemented:
- contractor_contacts
- normalization layer
- realtime validation
- InputMapper architecture

## Access Model

Visibility inheritance through contractor.

Do NOT introduce:
- driver_assignments
- vehicle_assignments

## Vehicle Philosophy

Vehicle represents:
- truck + trailer combination