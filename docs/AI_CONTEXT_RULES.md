# AI CONTEXT RULES

## Текущий runtime baseline
Система поддерживает Contractors, Drivers, Vehicles с operational upload workflow.

## Обязательные проверки перед фиксом
- `php -l` по затронутым PHP-файлам
- grep/rg по анти-паттернам
- проверка mojibake при изменениях русских текстов

## Политика required полей
### Contractors
- required: `name`, `inn`
- остальное optional (валидация формата только если поле заполнено)

### Drivers
- required: `full_name`, `phone`, `email`, `passport_number`, `passport_issue_date`, `passport_issued_by`, `license_number`, `license_issue_date`, `snils`

### Vehicles
- truck required: `truck_plate`, `truck_brand`, `truck_vin`, `truck_load_capacity`, `truck_body_volume`
- trailer required только если trailer active

## Upload workflow
- multiple files поддерживается
- один общий `Upload` на сущность
- скрытие предзаполненных блоков обязательных документов
- `other` всегда доступен
