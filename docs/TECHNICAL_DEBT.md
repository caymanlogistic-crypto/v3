# TECHNICAL DEBT

## Актуальные долги (не блокирующие checkpoint)
1. Legacy `app/Views/partials/header.php` содержит `/v3/public` и не синхронизирован с `layouts/main.php`.
2. В репозитории есть одновременно `app/Views/Modules/*` и `app/Modules/*/Views` legacy-структуры.
3. Нужен единый план постепенной локализации label-слоя (часть labels на English в active views).

## Что уже стабилизировано
- required-policy синхронизирована backend/frontend для Contractors/Drivers/Vehicles
- grouped multiple upload во всех 3 модулях
- vehicle trailer docs/photos поддержаны
- human-friendly dates в Drivers
- redirect update Vehicles на `/vehicles`

## Не делать без отдельной задачи
- удалять legacy поля БД
- менять permission model
- глубоко рефакторить routing/core
