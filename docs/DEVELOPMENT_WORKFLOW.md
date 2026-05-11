# DEVELOPMENT WORKFLOW

## Safe sequence
1. Audit
2. Minimal safe fix
3. Lint/grep checks
4. Docs sync
5. Commit/push

## Обязательные команды проверки
- `php -l <file>`
- `rg "window.location.origin" app public`
- `rg "/v3/public" app/Views public/assets`
- `rg "Paginator::build|previousPage|nextPage|currentPage|lastPage" app`
- `rg "Flash::setOld|Flash::getOld|Flash::setError|redirectBack|back\(" app`

## Encoding policy
- PHP/JS/MD хранить в UTF-8
- избегать регрессии mojibake
- при русских строках в views допускаются HTML entities

## Release note policy
В отчёте фиксировать:
- что изменено
- что найдено, но не менялось (risk/high-risk)
- точный git status после push
