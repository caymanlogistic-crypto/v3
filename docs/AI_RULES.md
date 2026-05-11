# AI RULES (Runtime-safe)

## Главный принцип
Любое изменение — только если подтверждено аудитом и безопасно для runtime.

## Что можно
- Локальные хотфиксы
- Исправление mojibake/UTF-8
- Синхронизация frontend/backend валидации
- Исправление labels/hints/messages
- Обновление docs под фактическое состояние

## Что нельзя без отдельного запроса
- Новые бизнес-фичи
- Изменение DB schema
- Редизайн архитектуры
- Переписывание модулей
- Удаление рабочей обратной совместимости

## Анти-галлюцинационные запреты
Не использовать:
- `use App\Core\Controller;`
- `Flash::setOld()` / `Flash::getOld()` / `Flash::setError()`
- `redirectBack()` / `back()`
- `Paginator::build()` / `previousPage()` / `nextPage()` / `currentPage()` / `lastPage()`
- `window.location.origin`
- хардкод `/v3/public` в новом/активном коде

Использовать:
- `config('app.url')`
- существующие контроллерные/middleware паттерны проекта

## Git-дисциплина
- Нельзя заявлять completion до успешных `commit + push`
- Проверять `git status` после push
