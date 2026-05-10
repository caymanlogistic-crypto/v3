# MASTER_CONTEXT.md

## Current Runtime Status

Transport ERP v3 is currently in stabilization-phase-2.

Current status:
- Contractors module is production-like operational ERP entity
- Contractor contacts implemented
- Backend normalization implemented
- Frontend realtime validation implemented
- Excel-tolerant input mapping implemented
- Storage foundation implemented
- CSRF stable
- Auth stable
- Routing stable
- Deploy workflow stable

## Current Priorities

1. Runtime stability
2. Validation + normalization
3. File workflows
4. Real logistics testing
5. UI cleanup
6. Drivers
7. Vehicles

## Contractors

Implemented:
- CRUD
- pagination
- search
- soft delete
- contractor_contacts
- realtime validation
- normalization
- UTF-8 normalization
- flash messages
- InputMapper pattern

Current contractors fields:
- name
- inn
- kpp
- ogrn
- okved
- legal_address
- actual_address
- director
- director_post
- contact1_name
- contact1_phone
- contact1_email
- bank_name
- bank_account
- bank_corr_account
- bank_bik
- comments
- status

Deprecated compatibility fields:
- contact2_name
- contact2_phone
- contact2_email

## Validation Philosophy

Frontend validation:
- UX helper only

Backend validation:
- authoritative

Flow:

Request
→ InputMapper
→ Validator
→ Save

## Access Model

Visibility inheritance through contractor.

logist
→ contractor assignment
→ contractor
→ contractor drivers
→ contractor vehicles

## Current Next Step

contractor_files upload/download/delete