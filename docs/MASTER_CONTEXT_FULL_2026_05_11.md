# MASTER CONTEXT FULL (2026-05-11)

## Checkpoint summary
- Contractors/Drivers/Vehicles runtime стабилизированы
- grouped multiple uploads работают
- required policies синхронизированы с runtime
- vehicle trailer docs/photos поддерживаются

## Required fields (runtime)
### Contractors
- name
- inn

### Drivers
- full_name
- phone
- email
- passport_number
- passport_issue_date
- passport_issued_by
- license_number
- license_issue_date
- snils

### Vehicles
Truck required:
- truck_plate
- truck_brand
- truck_vin
- truck_load_capacity
- truck_body_volume

Trailer required only when trailer active:
- trailer_plate
- trailer_brand
- trailer_vin
- trailer_load_capacity
- trailer_body_volume

## Vehicle file types
- sts
- diagnostic_card
- trailer_sts
- trailer_diagnostic_card
- truck_photo
- trailer_photo
- other

## Stability notes
- Использовать `config('app.url')` в активных views
- Не использовать несуществующие helper/flash/paginator методы
- Контролировать UTF-8 в русских строках
