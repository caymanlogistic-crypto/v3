# TransportERP — WEB Visual System Guide

**Назначение файла:**  
Этот документ нужен для WEB/AI-дизайн-агента, который будет помогать развивать визуальный стиль TransportERP, писать промты для новых экранов, оценивать макеты и предлагать UI-доработки.

Документ фиксирует текущий принятый visual direction системы.

---

# 1. Принятое направление

За основу принят стиль:

## Industrial Graphite + Warm Accent

Это не SaaS-dashboard, не Bootstrap-admin, не маркетинговая CRM и не “красивая админка”.

TransportERP должен выглядеть как:

- современная desktop-first ERP;
- плотный операционный back-office;
- промышленная рабочая система;
- строгий интерфейс для логистов, диспетчеров и менеджеров;
- спокойный enterprise-инструмент для ежедневной работы;
- production-grade UI без декоративной перегрузки.

Ключевое ощущение:

> не “красивый дашборд”, а серьёзная рабочая система управления транспортной операцией.

---

# 2. Контекст продукта

TransportERP — это транспортно-логистическая ERP-система.

Основные пользователи:

- логисты;
- диспетчеры;
- менеджеры;
- back-office;
- операторы, которые весь день работают с таблицами, формами, документами, рейсами и статусами.

Основные типы экранов:

- справочники;
- водители;
- контрагенты;
- транспорт;
- рейсы;
- планируемые маршруты;
- сформированные рейсы;
- документы;
- карточки сущностей;
- инспектор справа;
- формы редактирования;
- таблицы с большим количеством строк и колонок;
- статусы и операционные предупреждения.

---

# 3. Главный принцип UI

Интерфейс должен быть:

- плотным;
- быстрым;
- табличным;
- строгим;
- спокойным;
- без визуального шума;
- без лишнего воздуха;
- без декоративной “красоты”;
- удобным для работы весь день.

Важно:

> В ERP красота — это не большие карточки и тени. Красота — это плотность, ясность, ритм, предсказуемость и быстрое считывание состояния.

---

# 4. Что запрещено визуально

Не использовать:

- сине-белый SaaS-style;
- Bootstrap-admin look;
- большие скругления;
- крупные тени;
- gradient-heavy dashboard;
- карточный dashboard;
- огромные KPI-блоки;
- лендинговую типографику;
- декоративные иконки;
- “модные” крупные UI-card patterns;
- большие пустоты;
- glassmorphism;
- neumorphism;
- Tailwind UI style;
- Material Design look;
- случайные яркие статусы;
- кислотные Bootstrap-цвета.

Не превращать ERP в “красивый сайт”.  
Это рабочая операционная система.

---

# 5. Что нужно сохранять

Всегда сохранять:

- desktop-first подход;
- плотную сетку;
- compact controls;
- компактные таблицы;
- правый inspector panel;
- спокойные surface-слои;
- глубокий copper/warm accent;
- приглушённые статусы;
- tabular numeric typography;
- системные кнопки;
- очевидные hover/focus/error/warning/success states.

---

# 6. Цветовое направление

Основной характер:

- нейтрально-графитовый фон приложения;
- светлые, но не белоснежные рабочие поверхности;
- тёплый industrial accent;
- графитовый основной текст;
- мягкие линии;
- приглушённые статусы.

## Пример базовой палитры

```css
:root {
  --app-bg: #e2dfd8;

  --surface:           #f5f3ee;
  --surface-strong:    #fefdf8;
  --surface-muted:     #e8e4db;
  --surface-form:      #f0ede6;
  --surface-inspector: #f3f1eb;
  --surface-insp-head: #e6e1d6;
  --surface-field:     #fefdf8;
  --surface-field-alt: #f9f7f2;

  --line-hair:   #dedad0;
  --line-soft:   #c9c3b8;
  --line:        #a8a196;
  --line-strong: #827b70;

  --text-main:  #131210;
  --text-muted: #4c4840;
  --text-faint: #78726a;

  --accent:       #7c4718;
  --accent-hover: #683c13;
  --accent-deep:  #4e2d0e;
  --accent-light: #c09060;
  --accent-line:  #a06830;
  --accent-bg:    #e8dbc8;
}
```

Цвета можно уточнять, но нельзя менять направление на сине-белый SaaS или старую бежевую админку.

---

# 7. Surface hierarchy

В системе должны различаться уровни:

1. **App background**  
   Общий фон приложения. Чуть темнее и нейтральнее рабочих поверхностей.

2. **Main surface**  
   Основные панели: таблицы, формы, фильтры.

3. **Strong surface**  
   Чистые рабочие области, поля, белые участки.

4. **Muted surface**  
   Панели инструментов, фильтры, служебные зоны.

5. **Form surface**  
   Нижняя рабочая форма / editor.

6. **Inspector surface**  
   Правая панель выбранной сущности.

7. **Selected state**  
   Выбранная строка таблицы или активный элемент.

Нельзя, чтобы весь экран сливался в одну бежевую массу.

---

# 8. Типографика

Рекомендуемый стек:

```css
font-family: "IBM Plex Sans", "Inter", "Segoe UI", Arial, sans-serif;
```

Если нельзя подключать внешние шрифты:

```css
font-family: "Segoe UI", Arial, sans-serif;
```

Обязательно:

```css
font-variant-numeric: tabular-nums;
```

Это важно для:

- телефонов;
- дат;
- номеров рейсов;
- номеров документов;
- ИНН;
- статусов;
- счётчиков;
- документов;
- финансовых значений.

## Типографическая логика

- Page title: короткий, уверенный, не огромный.
- Section title: компактный uppercase / semi-uppercase.
- Table header: строгий, читаемый, компактный.
- Table body: плотный, 12–13px.
- Field label: маленький, чёткий, 10–11px.
- Button text: 11–12px, уверенный вес.
- Secondary text: приглушённый, но читаемый.

---

# 9. Layout pattern

Базовая структура ERP-экрана:

```text
┌─────────────────────────────────────────────── topbar ───────────────────────────────────────────────┐
│ sidebar │ breadcrumbs / system search / user                                                         │
├─────────┼────────────────────────────────────────────────────────────────────────────────────────────┤
│         │ page header                                                                                 │
│         │ filters                                                                                     │
│         │ ┌──────────────────────── main table / work area ────────────────┐ ┌──── inspector ───────┐ │
│         │ │ table toolbar                                                   │ │ selected entity      │ │
│         │ │ status filters                                                  │ │ tabs                 │ │
│         │ │ ERP grid                                                        │ │ operational info     │ │
│         │ │ pagination                                                      │ │ documents/activity   │ │
│         │ └────────────────────────────────────────────────────────────────┘ └──────────────────────┘ │
│         │ bottom editor form / detail form                                                             │
└─────────┴────────────────────────────────────────────────────────────────────────────────────────────┘
```

---

# 10. Кнопочная система

Кнопки должны быть системными, а не случайными HTML buttons.

## Типы кнопок

### Primary

Для главных действий:

- `+ Добавить водителя`;
- `+ Добавить рейс`;
- `Сохранить`;
- `Сохранить водителя`;
- `Сформировать рейс`.

Характер:

- глубокий copper;
- белый текст;
- компактная высота;
- уверенный border;
- не слишком большой radius;
- без жирной SaaS-тени.

### Secondary

Для второго по важности действия:

- `Сохранить черновик`;
- `Применить`;
- `Сохранить без отправки`.

### Ghost

Для отмены и нейтральных действий:

- `Отмена`;
- `Закрыть`;
- `Назад`.

### Toolbar

Для служебных действий:

- `Сброс`;
- `Фильтры`;
- `Экспорт`;
- `К первой ошибке`;
- `Настройки`.

### Toggle

Для переключателей:

- `Показать только ошибки`;
- `Только активные`;
- `Скрыть архив`.

---

# 11. Таблицы / ERP-grid

Таблица — главный рабочий объект ERP.

Требования:

- compact row height;
- sticky table header;
- аккуратные линии;
- не слишком тёмный header;
- hover state мягкий;
- selected row заметный, но не кричащий;
- selected row желательно с левой accent-line;
- row actions не должны быть визуальным мусором;
- scrollbars тонкие;
- числовые значения выровнены и читаемы.

Нельзя:

- делать таблицу как Bootstrap table;
- делать слишком большие строки;
- делать карточки вместо таблицы;
- перегружать цветами;
- делать кислотные статусы.

---

# 12. Правый inspector panel

Правая панель — это не “боковая колонка с текстом”.

Это inspector выбранной сущности.

Он должен показывать:

- заголовок сущности;
- статус;
- подзаголовок;
- вкладки;
- ключевую операционную информацию;
- документы;
- последние действия / назначения;
- связанные статусы.

Inspector должен быть:

- плотным;
- читаемым;
- структурированным;
- с чёткими секциями;
- без декоративных карточек;
- с аккуратными реестровыми строками.

---

# 13. Формы / ERP editor

Форма должна выглядеть как встроенный рабочий editor, а не как обычная HTML-форма.

Требования:

- unified input/select/textarea style;
- кастомная стрелка select;
- единая высота controls;
- мягкий focus;
- мягкие error/warning/success states;
- compact labels;
- compact field messages;
- нижняя action bar;
- checkbox/toggle слева;
- action buttons справа.

Состояния:

- error — заметный, но не агрессивный;
- warning — янтарный, чистый;
- success — спокойный зелёный;
- disabled/read-only — нейтральный.

---

# 14. Alerts

Использовать только по делу.

Типы:

- error alert;
- warning alert;
- success alert;
- info alert.

Alert должен быть:

- compact;
- readable;
- с левой accent-line;
- без больших иконок;
- без огромной высоты;
- без кислотных цветов.

---

# 15. Статусы водителей / документов

Статусы должны быть компактными badges:

- `Активен`;
- `Истекает`;
- `Проверка`;
- `Блок`;
- `Архив`;
- `Проверен`;
- `Ожидает`.

Badge pattern:

- маленькая цветная точка или marker;
- мягкий background;
- border;
- compact height;
- font-weight 700;
- приглушённый цвет.

Не использовать Bootstrap-like яркие labels.

---

# 16. Статусы рейсов

В системе есть 6 реальных статусов рейсов.

| Код | Название | Старый цвет | CSS-класс |
|---|---|---:|---|
| `search` | Поиск подрядчика | `#FFA459` | `.status-search` |
| `found` | Рейс сформирован | `#17a2b8` | `.status-found` |
| `started` | Вывоз начался | `#28a745` | `.status-started` |
| `completed` | Груз сдан | `#6c757d` | `.status-completed` |
| `attention` | Срочно к вывозу | `#dc3545` | `.status-attention` |
| `planned_route` | Планируемый | `#9c27b0` | `.status-planned_route` |

Старые цвета не использовать напрямую.  
Их нужно адаптировать в muted ERP palette.

## Рекомендуемая палитра

```css
:root {
  --flight-search-bg:     #fff0d8;
  --flight-search-text:   #7e420f;
  --flight-search-border: #d8a25e;
  --flight-search-dot:    #c07018;

  --flight-found-bg:     #e2f1f4;
  --flight-found-text:   #155f6c;
  --flight-found-border: #7abfc8;
  --flight-found-dot:    #228898;

  --flight-started-bg:     #e4f2ea;
  --flight-started-text:   #1c6340;
  --flight-started-border: #84b898;
  --flight-started-dot:    #267c50;

  --flight-completed-bg:     #e8e7e5;
  --flight-completed-text:   #545250;
  --flight-completed-border: #b8b4ae;
  --flight-completed-dot:    #6e6b66;

  --flight-attention-bg:     #fcecea;
  --flight-attention-text:   #8e2d25;
  --flight-attention-border: #ce8880;
  --flight-attention-dot:    #b83c34;

  --flight-planned-bg:     #ede6f2;
  --flight-planned-text:   #623579;
  --flight-planned-border: #be9ecf;
  --flight-planned-dot:    #7c4898;
}
```

## Flight-status component

```html
<span class="flight-status status-started">
  <span class="flight-status-dot"></span>
  Вывоз начался
</span>
```

Правила:

- compact inline badge;
- width by content;
- не растягивать на всю ширину;
- не progress-bar;
- не Bootstrap label;
- с marker-dot;
- мягкий background;
- аккуратный border.

---

# 17. Activity-list

Использовать для:

- последних назначений;
- истории действий;
- изменений статуса;
- логов карточки.

Pattern:

```text
Сегодня    Рейс №428 · A123BC77
           [● Вывоз начался]

Вчера      Рейс №421
           [● Груз сдан]
```

Activity-list должен быть компактным, но структурным.

---

# 18. Scrollbar

Scrollbars должны быть тонкими и спокойными.

Не использовать грубые системные scrollbar.

Пример:

```css
* {
  scrollbar-width: thin;
  scrollbar-color: #9e9890 #e4e0d8;
}

::-webkit-scrollbar {
  width: 4px;
  height: 4px;
}

::-webkit-scrollbar-track {
  background: #e4e0d8;
}

::-webkit-scrollbar-thumb {
  background: #9e9890;
}
```

---

# 19. Как писать промты для развития UI

Когда новый агент развивает экран, формулировать задачу так:

```text
Сохрани текущую UX-структуру TransportERP и visual direction Industrial Graphite + Warm Accent.
Не делай SaaS-dashboard, не добавляй большие скругления и тени.
Развивай экран как плотный desktop-first ERP-интерфейс.
Используй системные кнопки, таблицы, inspector, compact badges, muted statuses, unified form controls.
Не меняй бизнес-логику.
```

---

# 20. Acceptance checklist

Работа принимается, если:

- экран остаётся плотным;
- visual direction сохранён;
- таблица выглядит как ERP-grid;
- формы не выглядят дефолтными HTML controls;
- кнопки имеют понятную иерархию;
- inspector выглядит как inspector;
- статусы компактные и muted;
- рейсовые статусы представлены всеми 6 вариантами;
- интерфейс не скатывается в Bootstrap/admin/SaaS;
- нет больших скруглений и теней;
- нет бежевой однотонной массы;
- нет кислотных статусов.

---

# 21. Короткое резюме для агента

TransportERP UI = **Industrial Graphite + Warm Accent**.

Система должна быть:

- плотная;
- строгая;
- табличная;
- спокойная;
- промышленная;
- back-office;
- desktop-first;
- production-grade.

Не надо делать красиво.  
Надо делать **рабоче, чётче, строже и системнее**.
