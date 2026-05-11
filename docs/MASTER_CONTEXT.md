# MASTER CONTEXT — Transport ERP v3

## Текущее состояние (runtime)
Проект находится в **stabilization-first** режиме. Приоритет: предсказуемость runtime, простота сопровождения, совместимость с shared hosting.

## Реализованные модули

### Contractors
- CRUD подрядчиков
- Контакты подрядчиков
- Файлы подрядчиков
- DaData автозаполнение по ИНН
- Multiple upload
- Групповой один `Upload` для блоков документов
- Скрытие предзаполненных блоков после успешной загрузки (`contract`, `company_card`)
- Поле `other` всегда доступно
- Required policy: только `name`, `inn`

### Drivers
- CRUD водителей
- Файлы водителей
- Multiple upload
- Групповой один `Upload`
- Скрытие блоков `passport`, `license`, `snils` после загрузки
- `other` всегда доступно
- Человеко-дружественные даты в UI + backend-normalization
- Required policy:
  - `full_name`
  - `phone`
  - `email`
  - `passport_number`
  - `passport_issue_date`
  - `passport_issued_by`
  - `license_number`
  - `license_issue_date`
  - `snils`

### Vehicles
- CRUD транспорта
- Модель: тягач + опциональный полуприцеп
- Раздельные поля параметров:
  - `truck_load_capacity`, `truck_body_volume`
  - `trailer_load_capacity`, `trailer_body_volume`
- Коллапс/раскрытие блока полуприцепа
- Файлы транспорта
- Multiple upload
- Групповой один `Upload`
- Скрытие закрытых чек-листом блоков документов
- Фото тягача и полуприцепа
- Документы полуприцепа: `trailer_sts`, `trailer_diagnostic_card`
- Успешный update редиректит на `/vehicles`
- Required policy:
  - Тягач: `truck_plate`, `truck_brand`, `truck_vin`, `truck_load_capacity`, `truck_body_volume`
  - Если полуприцеп активен: `trailer_plate`, `trailer_brand`, `trailer_vin`, `trailer_load_capacity`, `trailer_body_volume`

## Vehicle file_type (требование текущего кода)
- `sts`
- `diagnostic_card`
- `trailer_sts`
- `trailer_diagnostic_card`
- `truck_photo`
- `trailer_photo`
- `other`

## UX/Foundation
- `public/assets/css/app.css` — базовый UX слой форм
- `public/assets/js/form-ux.js` — tooltip + normalization engine
- Подсказки, валидационные сообщения, компактный desktop-first ERP UI

## Строгие ограничения
- Без framework rewrite
- Без ORM/DI
- Без AJAX/upload redesign
- Без build tools
- Без изменения DB schema в стабилизационных хотфиксах
