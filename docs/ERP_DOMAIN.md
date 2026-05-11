# ERP DOMAIN (current scope)

## Сущности
- Contractor
- Driver
- Vehicle (truck + optional trailer)

## Documents domain
### Contractors
- contract
- company_card
- other

### Drivers
- passport
- license
- snils
- other

### Vehicles
- sts
- diagnostic_card
- trailer_sts
- trailer_diagnostic_card
- truck_photo
- trailer_photo
- other

## Operational principle
Документы ведутся как checklist-поток:
- загруженные обязательные блоки скрываются
- удаление документа возвращает блок в форму
