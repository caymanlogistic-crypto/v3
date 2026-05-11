# RUSSIAN MASTER DOCS ERP V3

Это агрегированный русский документ по актуальному состоянию ERP v3.

## Модули
- Contractors: CRUD, contacts, files, DaData, required only name+inn.
- Drivers: CRUD, files, human-friendly dates, strict required fields.
- Vehicles: CRUD, truck/trailer split, optional trailer, trailer docs/photos.

## Upload workflow
- multiple files
- grouped single Upload
- hide completed predefined blocks
- `other` always visible

## Vehicle file types
- sts
- diagnostic_card
- trailer_sts
- trailer_diagnostic_card
- truck_photo
- trailer_photo
- other

## Known AI pitfalls
- wrong controller import
- fake paginator methods
- `window.location.origin`
- hardcoded `/v3/public`
- false push completion reports
- UTF-8 regressions
