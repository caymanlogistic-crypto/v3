# CONTRACTORS_MODULE.md

## Current Status

Contractors module is canonical operational ERP module.

Implemented:
- CRUD
- pagination
- search
- soft delete
- contractor_contacts
- backend validation
- realtime validation
- normalization
- UTF-8 normalization

## contractor_contacts

Implemented.

Fields:
- full_name
- position
- role
- phone
- email
- is_primary
- is_payment_recipient
- is_document_recipient
- status
- comment

Roles:
- director
- manager
- accounting
- dispatcher
- owner
- other

Statuses:
- active
- inactive

## InputMapper

ContractorInputMapper implemented.

Normalizes:
- names
- emails
- numeric fields
- whitespace
- Excel-pasted input

## Realtime Validation

Implemented using vanilla JS.

Features:
- inline errors
- visible alert
- blocked invalid submit
- autofocus invalid field
- realtime validation