# UI GUIDELINES (ERP v3)

## Цель интерфейса
Компактный operational UI для desktop usage, без лишней декоративности.

## Текущее UX-ядро
- `public/assets/css/app.css`
- `public/assets/js/form-ux.js`
- tooltip help
- inline validation messages
- normalization on blur/paste

## Формы
- сохранять плотную структуру таблиц/секций
- избегать агрессивных перестроений DOM
- required markers только для реально required полей

## Upload UX
- блоки по типам документов (не dropdown)
- multiple file input
- один общий `Upload`
- скрытие уже закрытых обязательных блоков
- `other` всегда видим

## Запрещено
- `window.location.origin`
- hardcode `/v3/public`
- SPA/AJAX upload redesign
