# CONTRACTORS MODULE

## Реализовано
- CRUD подрядчиков
- Контакты (create/update/delete)
- Файлы (upload/download/delete)
- DaData lookup
- multiple upload + grouped upload submit
- скрытие блоков `contract`/`company_card` после загрузки

## Required policy
Required only:
- `name`
- `inn`

Остальные поля optional, но если заполнены — валидируются по формату.

## Документы contractors file_type
- `contract`
- `company_card`
- `other`

## UX
- operational блоки загрузки
- inline ошибки
- `other` всегда доступен
