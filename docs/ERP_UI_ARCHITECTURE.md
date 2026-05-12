# ERP UI/UX ARCHITECTURE & OPERATIONAL DESIGN SYSTEM
### Lightweight Transport/Logistics ERP — Complete Strategy Document

---

## TABLE OF CONTENTS

1. [ERP UI Philosophy](#1-erp-ui-philosophy)
2. [Visual Direction](#2-visual-direction)
3. [UX Principles](#3-ux-principles)
4. [Operational Ergonomics Strategy](#4-operational-ergonomics-strategy)
5. [Navigation Strategy](#5-navigation-strategy)
6. [Complete Form Design System](#6-complete-form-design-system)
7. [Form Rules and Standards](#7-form-rules-and-standards)
8. [Validation System Philosophy](#8-validation-system-philosophy)
9. [Upload / Document Workflow UX](#9-upload--document-workflow-ux)
10. [Table Strategy](#10-table-strategy)
11. [Status / Warning Strategy](#11-status--warning-strategy)
12. [Reusable UI System](#12-reusable-ui-system)
13. [Operational Workflow Recommendations](#13-operational-workflow-recommendations)
14. [CSS Architecture Proposal](#14-css-architecture-proposal)
15. [Layout Strategy](#15-layout-strategy)
16. [Future Module Consistency Strategy](#16-future-module-consistency-strategy)
17. [Crews / Tandems UX Strategy](#17-crews--tandems-ux-strategy)
18. [Phased UI Rollout Strategy](#18-phased-ui-rollout-strategy)
19. [Anti-Patterns to Avoid](#19-anti-patterns-to-avoid)
20. [ERP-Specific Usability Recommendations](#20-erp-specific-usability-recommendations)

---

## 1. ERP UI PHILOSOPHY

### 1.1 Core Identity

This ERP is not a consumer app. It is not a marketing dashboard. It is not a prototype. It is a professional operational tool used by logistics managers, dispatchers, and back-office staff who work inside it for 6–10 hours daily. Every design decision must be measured against this reality.

The ERP's identity is:

> **Operational clarity over visual decoration. Speed over aesthetics. Predictability over surprise. Density over whitespace. Control over automation.**

This is professional tooling. It should feel like a well-engineered instrument: purposeful, responsive, readable at a glance, forgiving of mistakes, and fast to operate.

### 1.2 What Users Need

Logistics staff are workflow-oriented, not exploration-oriented. They:

- Know exactly where to go
- Perform the same actions dozens of times per day
- Need to find information instantly
- Work under time pressure (dispatching is time-sensitive)
- Switch contexts rapidly between contractors, drivers, vehicles, crews
- Need warnings, not blocks — they know their business better than the system

This means the ERP must optimize for:

- **Recognition over recall** — UI elements must be immediately identifiable, not learned
- **Speed of action** — fewer clicks per task
- **Scannable data** — tables and forms that can be read top-to-bottom in under 3 seconds
- **Error tolerance** — the system guides, warns, but does not obstruct
- **State persistence** — user should never lose work or position

### 1.3 The Anti-Patterns This ERP Must Reject

| Anti-Pattern | Why It Fails in This ERP |
|---|---|
| Full-page modals for everything | Disrupts context, hard to navigate back |
| Wizard flows for simple entities | Too slow for repeated daily operations |
| Hidden actions in dropdowns | Increases click depth, wastes time |
| Paginated 10-row tables | Kills workflow for dense data |
| Autosave without confirmation | Creates trust issues in operational context |
| Toast-only validation | Operators miss floating messages |
| Card grids for entities | Wastes screen space vs. dense tables |
| Bright color everywhere | Fatigues eyes during long sessions |
| Giant modals with scrolling forms | Lose scroll position, feel unstable |

### 1.4 Philosophy Statement

> The ERP should feel like a professional logistics operator designed it for themselves. Clean enough to be readable. Dense enough to be efficient. Predictable enough to operate on autopilot after a week of use. Modern enough to not feel like legacy software. Fast enough to never make you wait.

---

## 2. VISUAL DIRECTION

### 2.1 Aesthetic Reference Points

**Primary references:**
- Linear — minimal chrome, high information density, fast keyboard navigation
- Stripe Dashboard — professional, data-first, typography-driven
- Modern logistics SaaS (e.g., Samsara operations view) — compact rows, status badges, operational hierarchy

**What to take from each:**
- From Linear: compact sidebar, action-first design, monochrome base with purposeful color
- From Stripe: tight typography, status badges, clean table rows, inline actions
- From logistics SaaS: status-color system, document indicators, operational density

### 2.2 Color Philosophy

The ERP uses a **near-neutral base with operational accent colors**. This is deliberate: long sessions in high-saturation interfaces cause eye fatigue and reduce focus. Operational color (status indicators, alerts) must stand out clearly against a muted base.

#### Base Palette

```
--color-bg-app:        #F7F8FA   /* overall app background, very light gray */
--color-bg-surface:    #FFFFFF   /* card/panel/form surfaces */
--color-bg-subtle:     #F1F3F6   /* table stripes, section backgrounds */
--color-bg-raised:     #FFFFFF   /* dropdowns, tooltips */

--color-border:        #E2E6EC   /* default borders */
--color-border-strong: #C8CDD6   /* emphasized borders, dividers */

--color-text-primary:  #1A1D23   /* main text, headings */
--color-text-secondary:#5A6070   /* labels, secondary info */
--color-text-muted:    #9099A8   /* placeholders, hints */
--color-text-inverse:  #FFFFFF   /* text on dark backgrounds */
```

#### Accent / Brand

```
--color-accent:        #2563EB   /* primary action, links */
--color-accent-hover:  #1D4ED8
--color-accent-light:  #EFF4FF   /* accent backgrounds, selected state */
```

#### Operational Status Colors

These are the most important colors in the ERP. They must be immediately legible without reading the label.

```
--color-status-active:    #16A34A   /* green — active, ready, complete */
--color-status-active-bg: #F0FDF4

--color-status-warning:   #D97706   /* amber — partial, needs attention */
--color-status-warning-bg:#FFFBEB

--color-status-danger:    #DC2626   /* red — inactive, error, missing critical */
--color-status-danger-bg: #FFF1F1

--color-status-neutral:   #6B7280   /* gray — inactive, archived, unknown */
--color-status-neutral-bg:#F3F4F6

--color-status-info:      #0EA5E9   /* blue — informational, in progress */
--color-status-info-bg:   #F0F9FF
```

#### Color Usage Rules

1. **Never use color purely decoratively.** Every color must carry meaning.
2. **Status colors are reserved for status.** Do not use green for decorative buttons.
3. **Accent (blue) = actionable.** Links, primary buttons, selected states only.
4. **Muted palette for all non-operational UI chrome.** Sidebar, headers, borders: near-neutral always.
5. **No gradients in operational UI.** Flat color only.
6. **No background colors on form fields** unless conveying state (error, disabled, readonly).

### 2.3 Typography System

Typography in an ERP is a functional system, not a stylistic statement. The font must be:
- Highly legible at small sizes (11–13px labels)
- Numerically clear (1, I, l must be distinct; 0, O must be distinct)
- Comfortable for 8-hour sessions
- Available without external loading (system or preloaded)

**Recommended font stack:**

```css
--font-primary: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
--font-mono: 'JetBrains Mono', 'Fira Code', 'Consolas', monospace;
```

Note on Inter: while it appears in the frontend-design skill's avoid list for consumer/marketing UI, for dense ERP data work it remains functionally superior to decorative alternatives. The goal here is operational readability, not creative differentiation.

**Type Scale:**

```
--text-xs:   11px / 1.4  — table meta, file sizes, timestamps
--text-sm:   13px / 1.5  — form labels, secondary text, table rows
--text-base: 14px / 1.6  — default body, form inputs
--text-md:   15px / 1.5  — section headings, card titles
--text-lg:   17px / 1.4  — page headings, module titles
--text-xl:   20px / 1.3  — major section titles (rare)
```

**Weight usage:**

```
--weight-normal:   400  — body text, form values
--weight-medium:   500  — labels, column headers, badges
--weight-semibold: 600  — section headings, page titles, emphasis
--weight-bold:     700  — reserved for critical alerts only
```

**Typography rules:**
- All form labels: 13px, weight 500, color `--color-text-secondary`
- All form values/inputs: 14px, weight 400, color `--color-text-primary`
- Table headers: 12px, weight 500, uppercase with letter-spacing 0.03em, `--color-text-muted`
- Table rows: 13–14px, weight 400
- Page title: 17px, weight 600
- Section title: 14px, weight 600

### 2.4 Spacing System

Base unit: **4px**. All spacing values are multiples of 4.

```
--space-1:   4px
--space-2:   8px
--space-3:   12px
--space-4:   16px
--space-5:   20px
--space-6:   24px
--space-8:   32px
--space-10:  40px
--space-12:  48px
--space-16:  64px
```

**Spacing usage patterns:**

| Context | Spacing |
|---|---|
| Between form field rows | 16px (space-4) |
| Between form sections | 32px (space-8) |
| Inside input padding (v/h) | 8px / 12px |
| Table row height | 40–44px |
| Table cell padding (h) | 12–16px |
| Sidebar padding | 12px |
| Page content padding | 24–32px |
| Card/section padding | 20–24px |
| Badge padding | 3px 8px |
| Button padding (sm) | 6px 12px |
| Button padding (default) | 8px 16px |
| Button padding (lg) | 10px 20px |

### 2.5 Border Radius

```
--radius-sm:   4px   — inputs, table rows, badges
--radius-md:   6px   — cards, dropdowns, popovers
--radius-lg:   8px   — modals, panels
--radius-xl:  12px   — larger surface containers (rare)
--radius-pill: 999px — pill badges, toggle switches
```

### 2.6 Shadows / Elevation

ERP UI uses minimal shadows. Shadows communicate layering, not decoration.

```
--shadow-sm:   0 1px 2px rgba(0,0,0,0.06)          — cards, inputs on focus
--shadow-md:   0 2px 8px rgba(0,0,0,0.09)           — dropdowns, tooltips
--shadow-lg:   0 4px 20px rgba(0,0,0,0.12)          — modals, panels
--shadow-inset: inset 0 1px 2px rgba(0,0,0,0.05)   — pressed states, inset inputs
```

Never use decorative shadows on flat operational UI elements.

---

## 3. UX PRINCIPLES

### 3.1 Principle 1: Predictability Above All

Every interaction must behave exactly as the user expects. No surprising animations. No unexpected redirects. No state loss. The ERP earns trust by being predictable. When a user saves a form, they know what happens next. When they click a table row, they know where they go.

### 3.2 Principle 2: Density with Breathing Room

Operational UIs can be dense without feeling cramped. The difference is **consistent internal rhythm**. Row heights, padding, and label/value spacing must be mathematically consistent. Operators scan UIs the way they scan spreadsheets: in horizontal and vertical lines. Any break in that rhythm slows them down.

### 3.3 Principle 3: Warnings Inform, Never Block

Logistics operators know their operational context better than the ERP does. A duplicate driver assignment might be intentional (covering for a shift). A missing document might be in progress. The ERP should:
- Always inform about potential issues
- Always allow the user to proceed despite warnings
- Only block on data integrity violations (e.g., required fields left empty on save)

### 3.4 Principle 4: Keyboard-First Interaction

Power users (dispatchers working fast) should be able to operate the entire ERP from the keyboard. This means:
- Logical tab order in all forms
- Enter to submit forms
- Escape to cancel/close
- Keyboard navigation in dropdowns and selects
- Access keys for primary actions (optional, progressively added)

### 3.5 Principle 5: Explicit Saves

The ERP does **not** autosave. Autosave in an operational context creates anxiety: "Did it save? When? Did the partial data save?" Explicit saves (button click) give operators control and confidence. Dirty-state detection (unsaved changes warning) provides the safety net.

### 3.6 Principle 6: No Dead Ends

Every page has a clear exit path. Every form has a cancel action. Every error has a resolution path. No user should ever be stuck, confused about how to get back, or face a dead state with no next step.

### 3.7 Principle 7: Status is Always Visible

At any moment, an operator must be able to determine:
- Is this contractor/driver/vehicle active or inactive?
- Is this record complete or missing required documents?
- Is this crew operational or has a warning?

Status is never hidden. It surfaces at the list level, at the detail level, and at the form level.

---

## 4. OPERATIONAL ERGONOMICS STRATEGY

### 4.1 Desktop-First Reality

This ERP is desktop-first. The target user is sitting at a workstation, often with a large monitor (1280px–1920px wide), using a mouse and keyboard. Mobile is not a priority. This enables:
- Wider tables with more visible columns
- Side-by-side form layouts
- Persistent sidebars
- Hover-based actions (row hover reveals action buttons)

Mobile strategy: basic responsiveness that makes the ERP usable on a tablet for reference lookup, but forms and tables are not redesigned for mobile.

### 4.2 Session Fatigue Reduction

For 8-hour sessions, the UI must reduce cognitive and visual fatigue:

- **Neutral backgrounds** — no bright white (#FFF) for large areas; use `--color-bg-app` (#F7F8FA)
- **Restrained color** — high contrast only where attention is needed
- **Consistent positioning** — primary actions always in the same place (top-right of page, bottom of form)
- **Predictable navigation** — no UX surprises mid-session
- **Readable font sizes** — never below 13px for interactive content
- **Non-distracting animations** — no bouncing, spinning, or attention-grabbing effects on routine actions

### 4.3 Repetitive Workflow Optimization

Dispatchers and back-office staff repeat the same workflows dozens of times per day. The ERP must:

- Remember the last-used filter state per module
- Pre-populate fields where context is known (e.g., when creating a crew, pre-suggest the most recently viewed contractor)
- Keep table column widths stable (no layout shifts)
- Keep form structure identical across similar entities (all onboarding forms have same section order)
- Provide keyboard shortcuts for primary save/cancel actions

### 4.4 Context Preservation

When a user navigates from a table row to a detail view, then into an edit form, then saves — they must return to the same position in the table they left. PHP server-rendered pages handle this via:
- Preserving scroll position (sessionStorage)
- Returning to the originating list with the same pagination/filter
- POST-Redirect-GET pattern on form submission to prevent re-submission on back

### 4.5 Information Hierarchy per Page

Every page has exactly one primary focal point. Secondary information supports, never competes.

**Page hierarchy:**
1. Page title + status badge (top-left)
2. Primary action button (top-right)
3. Alert/warning bar (below header, if applicable)
4. Main content (table or form)
5. Secondary actions (inline, contextual)

---

## 5. NAVIGATION STRATEGY

### 5.1 Layout Shell

The ERP uses a **fixed left sidebar + top bar + main content area** layout.

```
┌─────────────────────────────────────────────────────┐
│  TOP BAR: Logo | Search | User | Notifications      │
├──────────────┬──────────────────────────────────────┤
│              │                                      │
│   SIDEBAR    │   MAIN CONTENT AREA                  │
│   (fixed)    │   (scrollable)                       │
│              │                                      │
│   Nav items  │   Page header                        │
│              │   Alert bar (conditional)            │
│   Module     │   Content (table/form/detail)        │
│   groups     │                                      │
│              │                                      │
└──────────────┴──────────────────────────────────────┘
```

### 5.2 Sidebar Design

**Dimensions:** 220px wide, fixed, non-collapsible in initial version.

**Sidebar structure:**
- ERP logo / system name (top)
- Navigation groups with labels
- Active state: solid accent background on item
- Hover state: subtle background
- Group labels: 11px uppercase, muted, non-clickable

**Navigation groups (initial):**

```
OPERATIONS
  → Contractors
  → Drivers
  → Vehicles
  → Crews

(future)
DISPATCH
  → Trips
  → Orders

SYSTEM
  → Settings
```

**Sidebar behavior:**
- Active item is always highlighted
- No nested sub-menus in initial version (flat navigation)
- No icon-only collapse mode in initial version (simplicity first)

### 5.3 Top Bar

Minimal. Height: 52px.

Contains:
- Logo/system name (leftmost)
- Global search field (center, optional phase 2)
- User identity (right)
- (Optional) notification indicator

The top bar does **not** contain secondary navigation, breadcrumbs, or module-specific actions. Those live in the page header.

### 5.4 Page Header

Each content page has its own page header inside the main content area:

```
┌──────────────────────────────────────────────────────────────┐
│  [Page Title]  [Status Badge]              [Primary Action]  │
│  Breadcrumb (if nested)                                      │
│  ─────────────────────────────────────────────────────────── │
│  Alert / warning bar (if applicable)                         │
└──────────────────────────────────────────────────────────────┘
```

**Page header rules:**
- Title: 17px, semibold
- Status badge: immediately right of title
- Primary action button: always top-right
- Breadcrumb: only when 2+ levels deep (e.g., Contractors → ACME Logistics → Edit)
- Alert bar: only when there is a genuine operational warning

### 5.5 In-Page Navigation (Tabs)

Tabs are used **only within a detail/edit page** to organize content into logical sections that are too large for a single scrolling form.

**When tabs are appropriate:**
- Contractor detail page: General | Contacts | Files | Crews
- Driver detail page: General | Files
- Vehicle detail page: General | Files

**When tabs are harmful:**
- On list/table pages (no tabs — single view)
- On creation forms (no tabs — single flowing form)
- When there are fewer than 3 meaningful sections
- When sections are tightly related and should be seen together

**Tab behavior:**
- Active tab: bottom border in accent color, slightly darker text
- Inactive tab: muted text, no border
- Tab content switches without page reload (JS toggle or separate URL)
- Default tab is always the first (most frequently used)

### 5.6 Breadcrumbs

Used only for navigation context when 2+ levels deep:

```
Contractors / ACME Logistics / Edit
```

- 13px, muted color
- Separator: `/` character, not an icon
- All segments except the last are links
- Last segment is current page (not a link)

---

## 6. COMPLETE FORM DESIGN SYSTEM

### 6.1 Form Philosophy

Forms in this ERP are the primary way operators create, update, and manage operational data. They are used repeatedly, under time pressure, often for similar records (multiple drivers, multiple vehicles). Form design must therefore prioritize:

**Speed of entry over visual impressiveness.**
**Clarity of structure over creative layouts.**
**Predictability of behavior over smart automation.**

A logistics operator filling out their 15th driver form this week should be able to do so in under 2 minutes without re-reading labels. This is only possible if forms are structurally identical across entities, with consistent field positions, consistent tab order, and consistent save behavior.

### 6.2 What ERP Forms Should Feel Like

The mental model for a well-designed ERP form:

- **Like a physical intake form** — sections are logical, fields are grouped by meaning, the operator can fill top-to-bottom without jumping around
- **Like a spreadsheet row expanded** — compact, data-forward, not padded with whitespace
- **Like a tool, not a wizard** — gives access to everything at once, no artificial steps

Forms should feel **solid and stable**. No animations on field reveal. No floating labels that jump around. No surprise interactions. Labels are always visible above their fields.

### 6.3 How Users Scan Forms

Logistics operators scan forms in a modified F-pattern:
1. Read the section title (top-left of section)
2. Scan labels down the left column
3. Glance at the first value field
4. Tab through the rest without re-reading labels they recognize

This means:
- **Labels must be on top of fields, not inline** (inline labels disappear on focus/fill)
- **Left column alignment must be perfectly consistent** across sections
- **Section titles must be clearly distinct** from field labels
- **Visual grouping** (background, border, spacing) must signal "these fields belong together"

### 6.4 Form Structure Standards

#### 6.4.1 Single-Column vs Multi-Column

**Default: Two-column grid for forms.**

Two-column layouts match how logistics operators think about data: related pairs (first name / last name, phone / email, valid from / valid to). Two columns also make efficient use of desktop screen space without creating cramped feeling.

**Rules:**
- Two-column: default for all forms
- Single-column: long text areas, address blocks, file upload sections
- Three-column: only for groups of 3 tightly related short fields (e.g., city / state / zip — though this ERP is Polish, so city / postal code / country)

**Column width:** Each column is approximately 50% of the form content width, minus gap.

#### 6.4.2 Field Group Anatomy

```
┌──────────────────────────────────┐
│  SECTION TITLE                   │  ← 14px, semibold, color: text-primary
│  Optional section description    │  ← 13px, muted, optional
├──────────────────────────────────┤
│                                  │
│  Label *              Label      │  ← 13px, medium, secondary color
│  [________________]  [________]  │  ← 14px input, full width of column
│                                  │
│  Label                Label      │
│  [________________]  [________]  │
│                                  │
└──────────────────────────────────┘
```

#### 6.4.3 Section Grouping Strategy

Sections are visually separated containers. Each section:
- Has a clear title
- Groups fields that belong to the same semantic category
- Has consistent internal padding (20px)
- Is separated from adjacent sections by 32px vertical gap

**Grouping rules:**
- Group by data type and logical relationship, not by technical field type
- Never mix personal info and operational info in the same section
- Never group more than 8–10 fields in a single section (split into sub-sections)

**Standard section structure for entity forms:**

For **Contractor**:
1. Основная информация (Basic info) — name, INN, OGRN, legal form
2. Контактные данные (Contact info) — phone, email, website
3. Юридический адрес (Legal address) — address fields
4. Статус (Status) — active/inactive toggle, notes

For **Driver**:
1. Основные данные (Personal data) — full name, birth date
2. Контактные данные (Contact info) — phone, email
3. Водительское удостоверение (Driver's license) — license number, categories, valid from/to
4. Занятость (Assignment) — contractor link, status

For **Vehicle**:
1. Транспортное средство (Vehicle identity) — plate, brand, model, year
2. Документы (Documents) — STS number, registration details
3. Технические данные (Technical data) — type, capacity, etc.
4. Занятость (Assignment) — contractor link, status

#### 6.4.4 Section Visual Treatment

```css
/* Each section is a visually contained block */
.form-section {
  background: var(--color-bg-surface);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-md);
  padding: var(--space-6);         /* 24px */
  margin-bottom: var(--space-8);   /* 32px */
}

.form-section__title {
  font-size: var(--text-md);       /* 15px */
  font-weight: var(--weight-semibold);
  color: var(--color-text-primary);
  margin-bottom: var(--space-5);   /* 20px */
  padding-bottom: var(--space-3);  /* 12px */
  border-bottom: 1px solid var(--color-border);
}
```

#### 6.4.5 Sticky Form Actions

On long forms (height > ~80vh), the save/cancel action bar must be sticky at the bottom of the viewport.

```
┌─────────────────────────────────────────────────────┐
│  STICKY ACTION BAR (bottom of viewport)             │
│  [Unsaved changes indicator]   [Cancel] [Save]      │
└─────────────────────────────────────────────────────┘
```

**Sticky action bar rules:**
- Background: `--color-bg-surface` with top border
- Contains: Cancel (secondary), Save (primary, accent)
- Unsaved changes indicator: small dot or text "Есть несохранённые изменения"
- Never contains destructive actions (delete is not in the save bar)
- Always visible when form is long enough to scroll

#### 6.4.6 Collapsible Sections

Collapsible sections are used sparingly and only for:
- Optional secondary information (e.g., "Additional details" that most users skip)
- Historical/archive data that is rarely needed
- Advanced settings that would overwhelm basic users

**Rules for collapsible sections:**
- Default state: **open** for required or primary sections, **closed** for optional/secondary
- Toggle: chevron icon on the right of section title
- Never collapse sections that contain validation errors
- Never collapse sections that contain required fields (or expand them automatically on validation)

#### 6.4.7 Progressive Disclosure

Progressive disclosure in ERP forms means **revealing additional fields based on a prior selection**, not hiding fields behind multiple steps.

**Example:** If a contractor is set to "ИП" (sole proprietor), hide the OGRN field and show only OGRNIP. If "ООО", show OGRN.

This is implemented via simple JS field show/hide, not routing.

**Rules:**
- Never hide fields that will be needed for most records
- Disclose based on a clear, logical trigger (type selection, status change)
- Disclosed fields appear smoothly but without animation delay
- Disclosed fields are included in tab order immediately

### 6.5 Form Field Components

#### 6.5.1 Text Input

Standard single-line text input.

```
Label *
┌────────────────────────────────┐
│  Value text                    │
└────────────────────────────────┘
  Hint text (optional, muted)
```

**States:**
- Default: border `--color-border`, background white
- Focus: border `--color-accent`, box-shadow `--shadow-sm` in accent
- Filled: same as default (no special treatment)
- Error: border `--color-status-danger`, error message below
- Disabled: background `--color-bg-subtle`, text muted, cursor not-allowed
- Readonly: background `--color-bg-subtle`, no border highlight on focus

**Sizing:**
- Height: 36px (compact) or 40px (default)
- In dense forms: use 36px
- In main onboarding forms: use 40px

#### 6.5.2 Select / Dropdown

Standard select for fixed option lists.

- Uses custom-styled `<select>` or a lightweight JS-enhanced component
- No multi-select unless operationally required
- Searchable select for long lists (see 6.5.3)
- Chevron icon on right, no double native/custom chevrons

#### 6.5.3 Searchable Select (Combobox)

Used for:
- Contractor lookup (when assigning to driver or vehicle)
- Driver lookup (in crew creation)
- Vehicle lookup (in crew creation)
- Any list with 10+ options

**Behavior:**
- On focus: opens dropdown, shows all options (or top 10)
- On type: filters options in real-time
- On select: closes, shows selected value
- On clear: (x) button appears if clearable, removes selection
- Keyboard: arrow keys navigate, Enter selects, Escape closes

**Visual:** identical to standard input in default state; dropdown panel appears below with border and shadow.

#### 6.5.4 Date Fields

- Native `<input type="date">` for simplicity (no calendar picker library)
- Displays in DD.MM.YYYY format (localized display)
- Minimum/maximum constraints applied where relevant (e.g., license valid-to > valid-from)
- For date ranges: two separate fields labeled "С" (from) and "По" (to)

**Validation:**
- Invalid date formats rejected on blur
- Out-of-range dates show inline warning (soft) or error (hard, if required)

#### 6.5.5 Textarea

For notes, comments, descriptions. Auto-resize on content (CSS `field-sizing: content` or JS min-height approach).

- Minimum height: 80px (3 rows)
- Maximum height before scroll: 200px
- Full-width (spans both columns of form grid)

#### 6.5.6 Checkboxes and Toggles

**Checkboxes:**
- Used for multi-select option lists within a form
- Never used for binary on/off — use toggle instead
- Vertical list with 8px gap between items

**Toggles (Binary):**
- Used for: active/inactive status, yes/no flags
- Visual: pill-shaped toggle switch
- Label always visible on left side: "Активен" / "Не активен"
- Current state shown as text beside toggle (not just color)

#### 6.5.7 Phone Number Input

- Mask: +7 (___) ___-__-__
- Real-time masking as user types
- Accepts input with or without country code
- On paste: strips all non-digits, re-formats

#### 6.5.8 INN / OGRN / Document Number Inputs

- Masked by length constraints
- Real-time length validation indicator (character counter when near limit)
- DaData autofill integration: on INN blur, trigger lookup, pre-fill company name, address fields
- Show "Заполнено из ДаДата" badge on autofilled fields

#### 6.5.9 Inline Hint Text

Shown below field, 12px, muted:

- Used for: format hints ("Формат: XX XX XXXXXX"), business rules ("Введите ИНН без пробелов"), contextual help
- Never for field labels (labels live above, hints live below)
- Optional: hidden by default for expert users, shown via "?" icon that reveals on hover

#### 6.5.10 Readonly Display

When a form field is in readonly mode (view mode, not edit mode):

```
Label
Value text (no input border, just text)
```

Or: show as stylized "display field" with subtle background strip.

**Never show readonly values inside disabled inputs** — disabled inputs communicate "this could be changed but it's locked" which is wrong for readonly view.

---

## 7. FORM RULES AND STANDARDS

### 7.1 Required Field Rules

- Required fields are marked with `*` suffix on label
- `*` color: `--color-status-danger` (red)
- At top of each form with required fields: single line legend "* — обязательные поля"
- Never require fields that aren't truly required for operational function
- Required fields that are missing on save: show error state, scroll to first error

### 7.2 Optional Field Rules

- No marker on optional fields (the `*` on required fields implies others are optional)
- Optional fields may include a hint "(необязательно)" for clarity in complex forms
- Optional fields are placed after required fields within each section

### 7.3 Tab Order Strategy

Tab order follows the visual reading order: left column top-to-bottom, then right column top-to-bottom, then next section. This is achieved through logical DOM order matching visual layout.

```
Field A (col 1, row 1) → Field B (col 2, row 1) → Field C (col 1, row 2) → ...
```

Exception: within a two-column form, if a row's two fields are logically paired (first name / last name), tab order is left→right across the row, then down to the next row. This is the natural reading order and matches user expectations.

All interactive form elements must be reachable by Tab. Custom components (searchable selects, date pickers) must implement keyboard navigation internally.

### 7.4 Save Workflow Strategy

**Standard save flow:**

1. User fills form
2. User clicks "Сохранить" (Save) button or presses Enter (if applicable)
3. Client-side validation runs:
   - All required fields checked
   - Format validations checked
   - Errors displayed inline
4. If validation passes: form POSTs to server
5. Server processes:
   - If success: redirect to detail view (POST-Redirect-GET), success message shown
   - If server error: form re-shown with error messages from server
6. User sees the detail view of the saved record

**No confirmation dialogs for saves.** Saving is the expected action; no confirmation needed. Destructive actions (delete) require confirmation.

**Success feedback:**
- Flash message at top of page after redirect: green bar "Запись сохранена"
- Disappears after 4 seconds
- Does not require user dismissal

### 7.5 Cancel / Discard Workflow

- Cancel button always present next to Save
- If form is **clean** (no changes): Cancel navigates immediately back
- If form is **dirty** (changes made): browser `beforeunload` warning OR inline "У вас есть несохранённые изменения. Выйти?" confirmation
- Cancel always navigates to the detail view of the current entity (or list, for new records)

**Dirty state detection:**
- Track form's initial state on load (serialize to JSON or form data)
- On any input change, compare to initial state
- If different: set dirty flag, show dirty indicator in sticky action bar

### 7.6 Autosave Philosophy

**This ERP does NOT use autosave.**

Rationale:
- Operators sometimes begin filling a form and need to check information before committing
- Partial saves can create invalid operational records (e.g., a driver record with no license number)
- Autosave can conflict with multi-user scenarios (another user viewing the same record sees partial data)
- Explicit saves match the mental model of logistics operators (physical paperwork analogy)

**Draft saving (future consideration):** For very long multi-step workflows (crew creation with many selections), a local draft (sessionStorage) can preserve form state on accidental navigation away. This is a safety net, not autosave — it restores data when the user returns, it does not submit partial records.

### 7.7 Dirty State Handling

Visual dirty state indicators:

1. **Sticky action bar** shows "Есть несохранённые изменения" text in amber
2. Browser tab title prefixed with `●` (e.g., `● Редактирование | Водитель`)
3. **No** per-field dirty indicators (too noisy in dense forms)

On navigation attempt while dirty:
- `beforeunload` native browser dialog: "Изменения не сохранены. Покинуть страницу?"
- If using in-page navigation (SPA-like PHP rendering): custom confirm dialog

### 7.8 Validation Visibility Rules

**Inline validation — when to show:**

| Trigger | Behavior |
|---|---|
| Field blur (leaving field) | Run field-level validation, show error if invalid |
| Form submit | Run all field validations, show all errors |
| Realtime (while typing) | Only for format-masked fields (phone, INN) — show length/format progress |

**Inline validation — never show errors:**
- While user is actively typing in a field (except format masks)
- On page load (no pre-validation of empty required fields)
- On focus (before user has had a chance to enter anything)

**Error message placement:**
- Directly below the field, 12px text, danger color
- Short, specific, actionable: "Введите корректный ИНН (10 цифр)" not "Ошибка"
- One error message per field maximum (show the most important error)

**Error summary at top of form:**
- On submit with multiple errors: show a summary box at the top listing all errors as links
- "Обнаружено 3 ошибки: [Поле ИНН] [Телефон] [Дата рождения]"
- Each error in the summary scrolls to and focuses the relevant field

### 7.9 Realtime Normalization

Applied to specific fields while typing, not on blur:

- **Phone:** real-time masking to +7 (XXX) XXX-XX-XX format
- **INN/OGRN:** strip non-digits in real-time, enforce max length
- **Plate number:** uppercase, strip invalid characters, enforce Russian plate format
- **Email:** lowercase while typing (optional — may be unexpected)
- **Postal code:** digits only, max 6

Normalization should be transparent: the cursor position should not jump, the UX should feel like "the field accepts what I type and formats it."

### 7.10 Warning vs Blocking Philosophy

| Type | Behavior | Visual |
|---|---|---|
| **Hard block** | Prevents save until resolved | Red inline error, submit disabled |
| **Soft warning** | Allows save, operator must acknowledge | Amber warning box, save still available |
| **Informational** | No action required | Blue info note, non-intrusive |

**Hard blocks (system cannot proceed without these):**
- Required field empty on submit
- Data format invalid (e.g., INN wrong digit count)
- Date logic violation (end date before start date)
- Referential integrity (cannot delete a contractor who has active crew)

**Soft warnings (operator decision required):**
- Driver already assigned to another active crew
- Vehicle already assigned to another active crew
- License expiry date in the past
- File missing from expected document set
- Duplicate INN detected in system

**Soft warning behavior:**
- Warning appears below form section or in a warning bar at top of form
- Save button remains enabled
- Warning text: "Внимание: [condition]. Вы можете продолжить сохранение."

---

## 8. VALIDATION SYSTEM PHILOSOPHY

### 8.1 Two-Layer Validation Architecture

**Layer 1 — Client-side (JS):**
- Format validation (phone, INN, plate, date)
- Required field presence
- Date range logic
- Cross-field consistency (end > start)

Purpose: immediate feedback, reduce server round-trips for simple errors.

**Layer 2 — Server-side (PHP):**
- Business rule validation (duplicate INN, referential integrity)
- Database-level constraints
- Permission checks
- All client-side rules re-validated (client validation is UX, not security)

### 8.2 Server-Side Error Return

Server validation errors are returned to the PHP view and rendered in the same inline positions as client-side errors. The form is re-displayed with:
- Field values preserved (user does not re-type everything)
- Error messages shown below affected fields
- Error summary at top of form

### 8.3 DaData Integration UX

When DaData autofill is triggered (e.g., on INN input blur):

1. Show loading spinner on affected fields
2. On success: populate fields with a subtle "autofilled" indicator
3. User can override autofilled values (they are not locked)
4. If DaData returns no results: show "Данные не найдены. Заполните вручную." hint
5. If DaData errors: silently fail, user fills manually

Autofilled fields indicator:
- Small badge: "Данные из ФНС" or "Автозаполнено"
- Amber or info color
- Disappears once user edits the field

### 8.4 Field-Level Status Icons

Used sparingly. Never add icon clutter to every field.

- Required + empty on submit: `✕` icon in error color (right side of field)
- Validated + correct: no icon (silence = success; checkmarks on every field are noise)
- DaData autofilled: small database icon
- Readonly: lock icon (optional)

### 8.5 Cross-Form Duplicate Detection

When an INN, license plate, or license number is entered that already exists in the system:

1. On blur: trigger AJAX lookup
2. If duplicate found: show soft warning below the field
3. "Внимание: ИНН уже используется контрагентом [Name]. Проверьте запись."
4. Link to existing record for comparison
5. Do not block save (duplicates can be legitimate — different legal entities, data corrections)

---

## 9. UPLOAD / DOCUMENT WORKFLOW UX

### 9.1 Document Upload Philosophy

Documents in this ERP are operational records: licenses, registrations, contracts, PTOs. Their presence or absence directly affects whether a crew can be dispatched. The document upload UX must:

- Make document status immediately visible (what's uploaded, what's missing)
- Make uploading frictionless (single click, no multi-step)
- Group documents by logical category
- Show document completeness at a glance

### 9.2 Document Checklist Structure

Each entity (contractor, driver, vehicle) has a known set of expected document types. These are rendered as a **document checklist block**, not a generic file uploader.

```
┌─────────────────────────────────────────────────────────┐
│  DOCUMENTS                                              │
├─────────────────────────────────────────────────────────┤
│  ✓  Паспорт водителя                    [Просмотр]      │
│  ✓  Водительское удостоверение          [Просмотр]      │
│  ✗  Медицинская справка                 [Загрузить ▲]   │
│  ✗  Трудовой договор                    [Загрузить ▲]   │
│                                                         │
│  Прочие документы                       [+Добавить]     │
│     file-2023-agreement.pdf             [Просмотр] [✕]  │
│                                                         │
└─────────────────────────────────────────────────────────┘
```

### 9.3 Document Checklist Behavior

**Uploaded document row:**
- Checkmark icon (green) on left
- Document type name
- File name (truncated if long)
- Upload date (small, muted)
- "Просмотр" (View) action — opens file in new tab or lightbox
- "Заменить" (Replace) action — triggers new upload for same type
- "Удалить" (Delete) action — with confirmation for operational documents

**Missing document row:**
- X icon (amber or red) on left
- Document type name
- "Загрузить" (Upload) button — opens native file picker
- Drag-and-drop zone may appear on click

**Always-visible "Other documents" block:**
- Does not collapse even when no other documents uploaded
- Allows upload of any additional file
- Shows already-uploaded "other" files as a list below
- No checklist logic — free-form upload

### 9.4 Upload Interaction

**Click to upload:**
1. Click "Загрузить" button → native file picker opens
2. User selects file → immediate upload begins (AJAX/XHR)
3. Upload progress: small progress bar appears under the document row
4. On success: row updates to "uploaded" state, shows filename and view link
5. On failure: error message below the row, retry option

**Drag and drop:**
- Available for all upload zones
- Visual indicator when dragging over valid target: dashed border, subtle background
- Invalid file type: immediate rejection with type message

**File type rules:**
- Accepted: PDF, JPG, PNG, WEBP (for documents and photos)
- Maximum file size: 10MB per file (configurable)
- Multiple files for "other" category: multiple files selectable at once

### 9.5 Document Preview Philosophy

**In-line preview (optional):**
- Images: thumbnail in the document row (48×48px, clickable to full view)
- PDF: PDF icon, no inline preview (too heavy for operational context)

**Full preview:**
- Opens in new browser tab (simplest, most reliable)
- Alternative: lightbox overlay for images
- PDF: native browser PDF viewer in new tab

**Never:** embed PDF viewer in-page. Too heavy. Too unreliable across browsers.

### 9.6 Document Completeness Indicators

At the entity detail level, document completeness is surfaced as a status badge:

- **Полный комплект** — all required documents uploaded → green badge
- **Частично** — some required documents missing → amber badge + count
- **Не заполнено** — no documents uploaded → red badge

This badge appears:
- In the detail page header
- In the documents tab header
- In the list table as a column ("Документы")

### 9.7 Upload Zones in Forms

When document upload is part of a creation form (not a separate detail tab):

- Upload zone appears as a section at the bottom of the form
- Optional on initial create: "Документы можно загрузить после создания записи"
- If user wants to upload during creation: drag-and-drop area available
- Files are held in temp storage until form saves, then associated to new record

### 9.8 Operational Document Scanning UX

For back-office staff scanning physical documents and uploading to the ERP:

- The upload UI must be accessible from the detail view **without entering edit mode**
- Uploading documents should not require saving a form
- Document upload is a separate atomic action from record editing

This means: document upload blocks are **always available in view mode**, not just edit mode.

---

## 10. TABLE STRATEGY

### 10.1 Table Philosophy

Tables are the primary data discovery interface. Logistics staff spend more time reading tables than filling forms. Tables must be:

- **Scannable:** consistent column widths, alignment, and spacing
- **Actionable:** click a row to open detail; row-level actions accessible on hover
- **Filterable:** basic filter bar above table
- **Informative:** status and completeness visible without opening the record

### 10.2 Table Structure

```
┌──────────────────────────────────────────────────────────────────────┐
│  FILTER BAR: [Search] [Status ▼] [Contractor ▼]  [+ Добавить]       │
├───┬────────────────┬─────────────┬──────────────┬───────┬────────────┤
│ # │  NAME          │  INN        │  CONTACT     │  DOCS │  STATUS    │
├───┼────────────────┼─────────────┼──────────────┼───────┼────────────┤
│ 1 │  ACME Logistics│  7703456789 │  +7 495 ...  │  ●●○  │  Активен   │
│ 2 │  БетаТранс     │  5012348765 │  +7 916 ...  │  ●●●  │  Активен   │
│ 3 │  ГаммаГруз     │  7801234567 │  —           │  ○○○  │  Неактивен │
└───┴────────────────┴─────────────┴──────────────┴───────┴────────────┘
  Showing 1–25 of 43                             [← Пред.]  [1] [2] [Дальше →]
```

### 10.3 Column Design Rules

**Column header:**
- 12px, uppercase, weight 500, muted color
- Letter-spacing: 0.04em
- Sortable columns: chevron icon on right, clickable
- Non-sortable columns: no icon

**Column alignment:**
- Text columns: left-aligned
- Number columns: right-aligned
- Status/badge columns: center-aligned
- Date columns: right-aligned
- Action columns: right-aligned

**Column widths:**
- Fixed widths where possible to prevent layout shift on pagination
- Primary name column: flexible (takes remaining space)
- INN/code columns: fixed narrow (120–140px)
- Date columns: fixed (100–110px)
- Status badge column: fixed (90–100px)
- Actions column: fixed (auto to content)

### 10.4 Row Design Rules

- Row height: 40–44px
- Zebra striping: alternate rows with `--color-bg-subtle` background (very light)
- Hover state: `--color-accent-light` background (very light blue)
- Click target: entire row is clickable (links to detail)
- Selected state: accent-light background + left border in accent color

**Row actions (hover-reveal):**
- Appear on row hover, on the right side
- Max 3 actions per row: typically Edit, Files, Delete
- Action buttons are icon-only with tooltip on hover
- Actions have separate click target from row-click (row-click → detail, edit button → edit form)

### 10.5 Filter Bar

Above every table, a compact filter bar:

```
[🔍 Поиск по имени, ИНН...]  [Статус: Все ▼]  [Тип: Все ▼]     [+ Добавить запись]
```

**Filter bar rules:**
- Search input is always first (leftmost)
- Filter selects are ordered by importance (most-used first)
- "Add" button always rightmost
- Filters are applied immediately on change (no submit button needed for filters)
- Active filters are visually indicated: badge count or highlighted state on select

**No filter panel/drawer** in initial version. Inline filter bar is sufficient for the current data volume and user needs.

### 10.6 Pagination

Simple numbered pagination for server-rendered tables:

- Default page size: 25 rows
- Page size selector: 25 | 50 | 100
- Pagination bar: Previous | 1 | 2 | 3 | ... | Next
- Total record count: "Показано 1–25 из 43"

### 10.7 Empty States

When a filtered table returns no results:

```
┌────────────────────────────────────────────┐
│                                            │
│    🔍  Записи не найдены                   │
│    По вашему запросу ничего нет.           │
│    Попробуйте изменить фильтры.            │
│                                            │
└────────────────────────────────────────────┘
```

When a table is empty (no records at all):

```
┌────────────────────────────────────────────┐
│                                            │
│    📋  Водители не добавлены               │
│    Добавьте первого водителя.              │
│    [+ Добавить водителя]                   │
│                                            │
└────────────────────────────────────────────┘
```

### 10.8 Inline Editing vs Full Form

| Scenario | Approach |
|---|---|
| Simple single-field update (status toggle, note) | Inline edit in table row |
| Any form with 3+ fields | Full form page |
| Document upload | Separate document tab/section |
| Crew assignment | Full form page (operational complexity) |
| Record deletion | Inline confirmation row (no separate page) |

**Inline editing rules:**
- Only for single-field edits accessible from table
- Click on the cell to enter edit mode
- Enter to save, Escape to cancel
- Row stays expanded until saved or cancelled

### 10.9 Table-to-Form Transition

When clicking from table to form:

- No side panels in initial version — full page navigation
- Back button returns to same page/scroll position of the table
- Breadcrumb shows the path: Водители / Иванов Иван Иванович

Side panels (future consideration): when viewing a driver while dispatching a crew, a side panel allows quick reference without full navigation. This is phase 2 UX.

---

## 11. STATUS / WARNING STRATEGY

### 11.1 Status Badge System

Every entity has a primary status displayed as a badge:

**Badge anatomy:**
```
┌──────────────┐
│  ● Активен   │  ← colored dot + text, pill shape
└──────────────┘
```

**Standard statuses:**

| Status | Text | Color | Use Case |
|---|---|---|---|
| Active | Активен | Green | Contractor/driver/vehicle ready for operations |
| Inactive | Неактивен | Gray | Temporarily not in service |
| Archived | В архиве | Gray (muted) | Historical record, not operational |
| In Progress | В работе | Blue | Crew currently on trip (future) |
| Warning | Требует внимания | Amber | Document issues, expired license |
| Blocked | Заблокирован | Red | Cannot be used due to hard constraint |

**Badge rendering:**
- In tables: compact badge (no dot, small pill)
- In page headers: larger badge with dot
- In form fields (readonly status): badge format

### 11.2 Document Completeness Indicators

**In tables (document column):**
- Dots indicating completeness: ●●○ (2 of 3 documents uploaded)
- Or: numeric badge "2/3" with color coding
- Click opens document tab of the record

**In detail page header:**
- "Документы: Полный комплект" → green badge
- "Документы: 2 из 4" → amber badge
- "Документы: не заполнено" → red badge

### 11.3 Crew Readiness Indicators

A crew is **operationally ready** when:
- Contractor is active
- Driver is active and has no expired critical documents
- Vehicle is active and has no expired critical documents
- All three are linked and have no conflicts

Crew readiness badge:
- **Готов** — green — all components valid
- **Частично готов** — amber — warnings present but not blocking
- **Не готов** — red — hard problems (inactive member, critical expired document)

### 11.4 Warning Hierarchy in Forms

**Level 0 — Informational (blue):**
```
ℹ Данные были загружены из сервиса ДаДата и могут требовать проверки.
```

**Level 1 — Soft Warning (amber):**
```
⚠ Срок действия водительского удостоверения истёк 15 дней назад.
```
Save is still possible. Operator is informed.

**Level 2 — Operational Alert (amber, more prominent):**
```
⚠ Этот водитель уже включён в активную бригаду [Бригада #12].
Вы можете продолжить — в системе будет зафиксировано несколько назначений.
```

**Level 3 — Hard Block (red):**
```
✕ Невозможно сохранить: обязательные поля не заполнены (ИНН, Телефон).
```
Save is disabled. Operator must resolve.

### 11.5 Alert Component Anatomy

```
┌────────────────────────────────────────────────────────┐
│  [icon]  [Title of alert]                              │
│          Explanation text with detail.                 │
│          [Action link if applicable]                   │
└────────────────────────────────────────────────────────┘
```

- Border-left in status color (4px)
- Background in status background color
- Icon on left (warning triangle / info circle / x circle)
- Dismissible (✕ button) for informational only; warnings/errors are not dismissible until resolved

### 11.6 Active / Inactive / Archive Visual Language

| State | Visual Treatment |
|---|---|
| Active record | Normal appearance |
| Inactive record | Slightly muted text in table row (80% opacity) |
| Archived record | Muted text + strikethrough on status column |
| Active in another crew | Warning badge on entity |

Table rows for inactive/archived records:
- Not hidden by default (operators need to see them)
- Filterable: filter can show/hide inactive records
- Visually distinct but not so visually degraded that they can't be read

---

## 12. REUSABLE UI SYSTEM

### 12.1 Component Inventory

The following is the complete set of UI components needed for this ERP. Each must be consistently implemented with CSS variables and documented behavioral rules.

**Layout components:**
- `page-shell` — sidebar + topbar + content area wrapper
- `page-header` — title, breadcrumb, status, primary action
- `content-area` — main scrollable content container
- `section-card` — bordered card used for form sections
- `tab-bar` — horizontal tabs for detail pages
- `alert-bar` — full-width alert below page header

**Form components:**
- `form-grid` — two-column form layout grid
- `form-section` — bordered form section with title
- `form-field` — label + input + hint + error wrapper
- `input` — text input (all variants)
- `select` — native styled select
- `searchable-select` — combobox with search
- `date-input` — date field
- `textarea` — multiline text
- `toggle` — binary toggle switch
- `checkbox` — single or list checkboxes
- `upload-zone` — drag-and-drop file upload area
- `form-actions` — sticky save/cancel bar

**Table components:**
- `data-table` — full table with header, rows, pagination
- `filter-bar` — table filter controls
- `table-row-actions` — hover-reveal action buttons
- `pagination` — numbered pages

**Status / feedback components:**
- `status-badge` — colored pill badge
- `document-badge` — document completeness indicator
- `alert` — info/warning/error/success message block
- `flash-message` — temporary page-level success/error
- `empty-state` — empty table or section placeholder

**Document components:**
- `document-checklist` — grouped document upload list
- `document-row` — single document entry (uploaded or missing)
- `upload-progress` — upload progress indicator

**Interactive components:**
- `dropdown-menu` — action dropdown
- `confirm-dialog` — delete/destructive action confirmation
- `tooltip` — hover text for icons/abbreviated content

### 12.2 Component Implementation Strategy

Each component is implemented as:
1. A PHP template partial (reusable include)
2. A corresponding CSS block (BEM-like naming)
3. (If interactive) a vanilla JS controller class or simple script

No external component library. No framework. Plain PHP partials + CSS + JS.

### 12.3 BEM-Like CSS Naming Convention

```css
/* Block */
.form-section { }

/* Element */
.form-section__title { }
.form-section__body { }
.form-section__actions { }

/* Modifier */
.form-section--collapsible { }
.form-section--collapsed { }

/* State */
.form-section.is-collapsed { }
.form-field.is-error { }
.form-field.is-dirty { }
```

This naming is not strict BEM, but it is consistent and readable without a build tool.

---

## 13. OPERATIONAL WORKFLOW RECOMMENDATIONS

### 13.1 Contractor Onboarding Workflow

**Single-page form, no wizard.**

Rationale: Contractor creation is done infrequently by experienced staff. All data is available at time of creation. Splitting into steps would add overhead without benefit.

**Form structure:**
1. Basic details (name, type, INN, OGRN)
2. Contact information
3. Legal address (DaData autofill from INN)
4. Status (active/inactive)
5. (On creation: skip document upload — redirect to detail page after save)

**After save:** Redirect to contractor detail page, tab "Документы" is highlighted with a hint "Загрузите документы для завершения онбординга."

**Onboarding completion indicator:**
- On contractor detail: progress bar or checklist of "onboarding steps"
- Steps: ✓ Основные данные, ✓ Контакты, ○ Документы, ○ Первый водитель

### 13.2 Driver Onboarding Workflow

**Single-page form, no wizard.**

Driver data is compact. The form fits on one page without excessive scrolling.

**Form structure:**
1. Personal data (full name, birth date)
2. Contact info
3. Driver's license data
4. Contractor assignment (searchable select)
5. Status

**After save:** Redirect to driver detail. Upload prompt for documents.

### 13.3 Vehicle Onboarding Workflow

**Single-page form, no wizard.**

**Form structure:**
1. Vehicle identity (plate, brand, model, year, type)
2. Registration document data (STS)
3. Technical data (capacity, body type)
4. Contractor assignment
5. Status

**After save:** Redirect to vehicle detail.

### 13.4 Crew / Tandem Creation Workflow

**This is the one workflow that benefits from guided interaction, but NOT a full wizard.**

The crew creation form is a single page but is structured as a sequential selector:

```
┌─────────────────────────────────────────────────────┐
│  СОЗДАНИЕ БРИГАДЫ                                   │
├─────────────────────────────────────────────────────┤
│  1. КОНТРАГЕНТ                                      │
│     [Выберите контрагента ▼]  [ACME Logistics ✓]    │
│                                                     │
│  2. ВОДИТЕЛЬ                                        │
│     [Выберите водителя ▼]     (фильтруется по 1)    │
│     ⚠ Этот водитель уже в бригаде #8                │
│                                                     │
│  3. ТРАНСПОРТНОЕ СРЕДСТВО                           │
│     [Выберите ТС ▼]           (фильтруется по 1)    │
│                                                     │
│  4. СТАТУС И ПЕРИОД                                 │
│     Активен [toggle]                                │
│     Дата начала: [____]                             │
│     Примечание: [________]                          │
│                                                     │
│  ┌─ ПРЕДПРОСМОТР БРИГАДЫ ────────────────────────┐  │
│  │  ACME Logistics + Иванов И.И. + А001АА 77     │  │
│  │  Статус: ⚠ Предупреждения (1)                 │  │
│  └───────────────────────────────────────────────┘  │
│                             [Отмена] [Создать]       │
└─────────────────────────────────────────────────────┘
```

**Key behaviors:**
- Driver and Vehicle selects are filtered by the selected Contractor (show only that contractor's drivers/vehicles)
- Selecting all three triggers a live preview panel showing the assembled crew
- Warnings (duplicate assignment, expired documents) shown in real-time in the preview panel
- Warnings do NOT block creation
- "Создать" saves the crew record

**This is not a wizard** — all fields are visible simultaneously. The numbering (1, 2, 3, 4) is visual guidance, not step enforcement.

### 13.5 Crew Switching Workflow

When a driver or vehicle needs to move to a new crew:

1. Operator opens the existing crew → marks it inactive (or sets an end date)
2. Operator creates a new crew with the new combination
3. Historical crew is preserved with original data and dates
4. Both old and new crews are visible in the crew list (filtered by active/inactive)

**Alternative fast path (phase 2):**
- On crew detail: "Создать новую версию бригады" button
- Pre-populates new crew form with same contractor, allows swapping driver or vehicle
- Old crew is automatically marked inactive

### 13.6 Where Wizard UX Is Useful vs Harmful

**Wizard UX is useful when:**
- The workflow has truly distinct stages where later stages depend on earlier ones
- Data entry is too long to show on one screen without overwhelming the user
- The workflow is done infrequently (so users benefit from guided steps)
- Completing each step generates a server-side object that the next step references

**In this ERP, wizard UX may be useful for:**
- Future trip creation (Select crew → Select route → Specify cargo → Confirm → Dispatch)
- Complex document approval workflows (if implemented)

**Wizard UX is harmful when:**
- The form is simple enough to see on one screen
- Users perform the workflow many times per day (wizard adds overhead)
- All fields are logically related and should be seen together
- The user needs to jump between sections while filling in

**In this ERP, wizard UX is harmful for:**
- Contractor, driver, vehicle creation (single-page always)
- Crew creation (sequential visual guidance on one page, not wizard steps)
- Document upload (direct upload, no steps)

---

## 14. CSS ARCHITECTURE PROPOSAL

### 14.1 File Organization

```
/assets/css/
  tokens.css          ← CSS custom properties (design tokens)
  reset.css           ← minimal CSS reset
  base.css            ← typography, global element styles
  layout.css          ← page shell, sidebar, topbar, content area
  components/
    forms.css         ← all form components
    tables.css        ← table styles
    buttons.css       ← button system
    badges.css        ← status badges
    alerts.css        ← alert/warning blocks
    navigation.css    ← sidebar, tabs, breadcrumbs
    uploads.css       ← document upload components
    modals.css        ← confirmation dialogs
    utilities.css     ← helper classes
  pages/
    contractors.css   ← page-specific overrides (minimal)
    drivers.css
    vehicles.css
    crews.css
```

**Loading strategy:**
- `tokens.css` and `base.css` loaded on every page (small, cached)
- `components/*.css` can be concatenated into a single `app.css` for production
- `pages/*.css` loaded only on relevant pages (minimal, mostly empty initially)

### 14.2 CSS Custom Properties Strategy

All design values defined in `tokens.css`. Never hard-code colors, spacing, or typography values in component CSS.

```css
/* tokens.css */
:root {
  /* Colors */
  --color-bg-app: #F7F8FA;
  /* ... all tokens from Section 2 ... */

  /* Typography */
  --font-primary: 'Inter', 'Segoe UI', system-ui, sans-serif;
  --text-sm: 13px;
  /* ... */

  /* Spacing */
  --space-4: 16px;
  /* ... */

  /* Component-level tokens */
  --input-height: 36px;
  --input-radius: var(--radius-sm);
  --input-border: 1px solid var(--color-border);
  --input-padding: 8px 12px;

  --table-row-height: 42px;
  --table-cell-padding: 0 16px;

  --sidebar-width: 220px;
  --topbar-height: 52px;
}
```

**No dark mode in v1.** Dark mode adds significant complexity. If added later, implement via `[data-theme="dark"]` attribute on `:root` that overrides token values.

### 14.3 CSS Reset

Minimal reset, not a full normalize:
- `box-sizing: border-box` on everything
- Remove default margins from headings, p
- Remove list styles from nav lists
- Input and button font inheritance
- No more than 30 lines total

### 14.4 Utility Classes

A small set of utility classes for common adjustments — not a full utility framework:

```css
.sr-only          /* screen reader only */
.text-muted       /* muted text color */
.text-danger      /* danger text color */
.text-success     /* success text color */
.mt-4             /* margin-top: 16px */
.mb-4             /* margin-bottom: 16px */
.flex             /* display: flex */
.flex-center      /* flex + align/justify center */
.gap-2            /* gap: 8px */
.d-none           /* display: none */
.w-full           /* width: 100% */
```

No more than 40–50 utility classes. Do not replicate Tailwind.

### 14.5 Icon Strategy

**Recommended: Lucide Icons (SVG sprite or individual SVGs)**

Rationale:
- MIT licensed, free
- Consistent visual style (clean, 24px grid)
- Available as individual SVGs — no font files, no external dependency
- Sprites can be inlined in the PHP layout for zero HTTP requests

**Usage pattern:**
```html
<svg class="icon icon--sm" aria-hidden="true">
  <use href="/assets/icons/sprite.svg#check-circle"></use>
</svg>
```

**Icon sizes:**
```css
.icon--xs   { width: 14px; height: 14px; }
.icon--sm   { width: 16px; height: 16px; }
.icon        { width: 20px; height: 20px; }  /* default */
.icon--lg   { width: 24px; height: 24px; }
```

**Icon color:** inherits `currentColor` — set via parent's color property.

### 14.6 Z-Index Philosophy

```css
/* z-index scale — named levels */
--z-base:      0
--z-raised:    10    /* sticky table headers */
--z-sticky:    100   /* sticky form action bar, sticky topbar */
--z-dropdown:  200   /* dropdowns, searchable select panels */
--z-tooltip:   300   /* tooltips */
--z-modal:     400   /* confirmation dialogs */
--z-flash:     500   /* flash messages */
```

Never use arbitrary z-index values outside this scale.

### 14.7 JavaScript Architecture

**Vanilla JS, no frameworks. Event-driven, module-based.**

```
/assets/js/
  app.js              ← entry point, initializes modules
  modules/
    form-dirty.js     ← dirty state detection
    form-validate.js  ← client-side validation
    searchable-select.js ← combobox component
    upload.js         ← file upload handling
    table-filter.js   ← filter bar behavior
    crew-form.js      ← crew creation real-time preview
    dadata.js         ← DaData autofill integration
    flash.js          ← auto-dismiss flash messages
    confirm.js        ← confirmation dialogs
```

**JS principles:**
- No global variables (use module pattern or IIFE)
- Data passed to JS via `data-*` attributes or `<script type="application/json">` blocks
- Event delegation for dynamic content
- No AJAX for page navigation (standard PHP server rendering)
- AJAX only for: file upload, duplicate detection, DaData lookup, crew real-time preview

---

## 15. LAYOUT STRATEGY

### 15.1 Page Shell Structure

```
body
└── .app-shell
    ├── .topbar (height: 52px, position: sticky, top: 0, z-index: var(--z-sticky))
    ├── .app-body
    │   ├── .sidebar (width: 220px, position: sticky, top: 52px, height: calc(100vh - 52px))
    │   └── .content-area (flex: 1, overflow: auto, padding: 24px 32px)
    │       ├── .page-header
    │       ├── .alert-bar (conditional)
    │       └── .page-content
```

**Content area max-width:**
- For tables: no max-width (use full available width)
- For forms: `max-width: 900px` (keeps forms readable, not too wide)
- Centered within content area

### 15.2 Form Layout

```
.form-page
├── .form-header (title, breadcrumb)
└── .form-body (max-width: 800px)
    ├── .form-section (repeated per section)
    │   ├── .form-section__title
    │   └── .form-grid (display: grid; grid-template-columns: 1fr 1fr; gap: 16px 24px)
    │       ├── .form-field (normal)
    │       └── .form-field--full (spans both columns: grid-column: 1/-1)
    └── .form-actions (sticky bottom)
```

### 15.3 Detail Page Layout (with Tabs)

```
.detail-page
├── .page-header (title, status badge, edit button)
├── .tab-bar
│   └── .tab-bar__tabs (Общее | Контакты | Файлы | Бригады)
└── .tab-content
    └── .tab-panel (active)
        ├── [section-specific content]
```

### 15.4 Table Page Layout

```
.table-page
├── .page-header (title, count, + Add button)
├── .filter-bar
└── .data-table-container
    ├── .data-table
    └── .pagination
```

### 15.5 Mobile Strategy

**Approach: minimal responsiveness, not full mobile redesign.**

At `< 1024px`:
- Sidebar collapses to icon-only (via hamburger toggle)
- Content area takes full width
- Tables become horizontally scrollable containers

At `< 768px`:
- Tables show only critical columns (name, status, primary action)
- Forms switch to single-column layout
- No major layout restructuring — this is an edge case for this ERP

**This ERP is not designed for phone use.** Tablet use (for reference lookup while in the field) is a secondary use case that the minimal responsive approach handles adequately.

---

## 16. FUTURE MODULE CONSISTENCY STRATEGY

### 16.1 Module Template

Every future module (Trips, Orders, etc.) follows the same structural template:

1. **List page** — table with filter bar, standard columns, row actions
2. **Create form** — single-page form, standard section layout
3. **Detail page** — tabs for General | Documents | Related entities
4. **Edit form** — same structure as create, pre-filled

No module deviates from this template without documented justification.

### 16.2 CSS Inheritance

Each new module:
- Inherits all tokens from `tokens.css`
- Inherits all component styles from `components/*.css`
- Adds a `pages/[module].css` only for genuine module-specific overrides
- Does not re-implement any component styles locally

### 16.3 PHP Partial Library

A library of PHP template partials is maintained:

```
/views/partials/
  _page-header.php
  _form-section.php
  _form-field.php
  _form-actions.php
  _status-badge.php
  _document-checklist.php
  _data-table.php
  _filter-bar.php
  _pagination.php
  _alert.php
  _flash.php
  _tab-bar.php
  _confirm-dialog.php
  _empty-state.php
```

Every module uses these partials. Never duplicate layout code in a new module.

### 16.4 Scalability Checkpoints

Before adding a new module, verify:
- [ ] New entity fits into existing entity taxonomy (or defines a new group)
- [ ] Standard list/create/detail/edit template is sufficient
- [ ] No new component types are needed (or they are documented and added to the shared system)
- [ ] New module CSS is minimal (< 50 lines of actual module-specific styles)

---

## 17. CREWS / TANDEMS UX STRATEGY

### 17.1 Crew as a First-Class Operational Entity

A crew (бригада) is not just a join table. It is an operational entity with its own:
- Status (active / inactive / historical)
- Timeline (start date, end date)
- Notes and context
- Document linkage (future: crew-level documents, trip log)
- Warnings and readiness state

The crew must have its own full detail view, not just be an embedded section in a contractor or driver record.

### 17.2 Crew List View

The crew list table shows:

| # | Контрагент | Водитель | ТС | Статус | Период | Готовность |
|---|---|---|---|---|---|---|
| 1 | ACME Logistics | Иванов И.И. | А001АА 77 | Активен | с 01.01.2024 | ✓ Готов |
| 2 | ACME Logistics | Петров С.В. | В002ВВ 77 | Активен | с 15.02.2024 | ⚠ Внимание |

**Filter options:** by contractor, by status (active/inactive/all), by readiness.

### 17.3 Crew Detail View

Crew detail shows:
- Crew identifier (auto-generated or meaningful name)
- Status badge + readiness badge
- Three-panel summary: Contractor card | Driver card | Vehicle card
- Timeline section
- Warnings panel (if any active warnings)
- (Future) Trip history

**Three-panel summary:**
```
┌─────────────────┬─────────────────┬─────────────────┐
│  КОНТРАГЕНТ     │   ВОДИТЕЛЬ      │   ТС            │
│  ACME Logistics │  Иванов И.И.    │  А001АА 77      │
│  Активен        │  Активен        │  Активен        │
│  Документы ✓    │  Документы ⚠    │  Документы ✓    │
│  [Открыть →]    │  [Открыть →]    │  [Открыть →]    │
└─────────────────┴─────────────────┴─────────────────┘
```

Each panel links to the full detail of that entity. Warnings (expired documents, inactive status) are surfaced at the crew level so the dispatcher doesn't need to open each entity separately.

### 17.4 Duplicate Assignment Handling

**Policy:** Duplicate active assignments (same driver or vehicle in two active crews) produce warnings, not hard blocks.

**Implementation:**
1. On crew creation/activation: check if driver or vehicle is already in another active crew
2. If yes: show amber warning in the crew form preview
3. Warning text: "Водитель Иванов И.И. уже входит в активную бригаду #8 (ACME Logistics). При необходимости деактивируйте предыдущую бригаду."
4. Operator can override — create crew with acknowledged duplicate
5. Both crews stored — duplicate state visible in driver's crew tab

### 17.5 Historical Crew Preservation

All deactivated crews are preserved. This is critical for:
- Trip history reconstruction (which crew was active for which trip)
- Audit trail
- Driver/vehicle assignment history

**Historical crews in the list:**
- Shown when "Показать архивные бригады" filter is enabled
- Visually muted (lower opacity, italic date range)
- Not deletable (archive only)

### 17.6 Crew Readiness Computation

Readiness is computed at display time (not stored) based on:

```
crew.readiness = f(
  contractor.is_active,
  driver.is_active,
  vehicle.is_active,
  driver.license_valid_to > today,
  driver.required_docs_uploaded,
  vehicle.sto_valid,
  vehicle.required_docs_uploaded
)
```

**Readiness levels:**
- **Ready:** all above true
- **Warning:** minor issue (document expiring soon, optional doc missing)
- **Not Ready:** any member inactive, critical doc expired or missing

### 17.7 Crew for Trip Dispatch (Future)

When trips are implemented, crew selection for a trip:
- Shows only **active, ready** crews by default
- Filter to show warning-state crews with explicit acknowledgment
- Trip form: searchable crew select shows crew summary card in dropdown

---

## 18. PHASED UI ROLLOUT STRATEGY

### Phase 0 — Stabilization (Now)
- Existing modules function correctly
- No UI overhaul yet
- Focus: backend correctness, data integrity, core validation

### Phase 1 — Token Foundation
**Goal:** Establish the design token layer without changing visible UI

- Create `tokens.css` with all CSS custom properties
- Apply tokens to existing CSS (replace hard-coded values)
- No visual change for users
- Validation: all existing CSS passes through tokens

### Phase 2 — Form Standardization
**Goal:** Apply form design system to all existing forms

- Implement `forms.css` with form components
- Standardize all form layouts (two-column grid, section cards)
- Implement sticky action bars
- Implement inline validation
- Apply to: Contractors, Drivers, Vehicles forms

### Phase 3 — Table Standardization
**Goal:** Consistent table design across all modules

- Implement `tables.css`
- Standardize filter bars
- Implement row hover actions
- Standardize pagination
- Apply status badges

### Phase 4 — Document Upload Overhaul
**Goal:** Document checklist system across all entity types

- Implement document checklist component
- Apply to Contractor Files, Driver Files, Vehicle Files
- Document completeness indicators in tables and headers

### Phase 5 — Navigation Shell
**Goal:** Implement full page shell (sidebar, topbar, layout)

- Implement sidebar with module navigation
- Implement page header component
- Standardize breadcrumbs

### Phase 6 — Crews Module
**Goal:** Build crews module on top of complete design system

- Crew list, create, detail, edit views
- Real-time crew preview in creation form
- Readiness computation
- Duplicate warning system

### Phase 7 — Polish and Consistency Audit
**Goal:** Audit all modules for consistency, fix gaps

- Cross-module consistency review
- Keyboard navigation audit
- Empty state coverage
- Error state coverage
- Performance audit

---

## 19. ANTI-PATTERNS TO AVOID

### 19.1 Visual Anti-Patterns

| Anti-Pattern | Problem | Alternative |
|---|---|---|
| Full-width white background | Harsh, causes fatigue | Use `--color-bg-app` (#F7F8FA) |
| Pure black text (#000) | Too harsh on light bg | `--color-text-primary` (#1A1D23) |
| Gradients on buttons | Looks dated, hard to maintain | Flat accent color |
| Icon-only action buttons (no tooltip) | Inaccessible, confusing | Always add tooltip |
| 3+ accent colors in one view | Visual noise | Max 1 accent per UI area |
| Colored backgrounds on form fields | Distracting | White + border only |
| Excessive border radius | Looks consumer/mobile | 4–6px only |
| Drop shadows on everything | Makes UI feel heavy | Shadows only for layered elements |

### 19.2 UX Anti-Patterns

| Anti-Pattern | Problem | Alternative |
|---|---|---|
| Confirmation dialog for saves | Slows down workflow | Dirty state + cancel path |
| Autosave without undo | Creates anxiety | Explicit save only |
| Pagination without page size control | Forces scroll on dense data | Always offer 25/50/100 |
| Hidden columns behind hamburger | Operators can't see all data | Show key columns, allow column config (v2) |
| Inline errors that appear while typing | Disruptive mid-input | Only on blur or submit |
| Disabling the save button for soft warnings | Blocks legitimate operations | Never disable save for warnings |
| Modal for record creation | Loses context, awkward on scroll | Full page always |
| Toast-only error notifications | Missed on long forms | Inline + summary always |

### 19.3 Technical Anti-Patterns

| Anti-Pattern | Problem | Alternative |
|---|---|---|
| Inline styles in PHP templates | Unmaintainable | All styles in CSS |
| JavaScript-dependent layouts | Breaks without JS | CSS-first, JS enhances |
| Non-semantic HTML for layout | Screen reader failures | Semantic HTML always |
| Z-index: 9999 | Z-index wars | Named z-index scale |
| Tailwind CDN build | Not aligned with architecture | Custom CSS tokens |
| jQuery for simple interactions | Unnecessary dependency | Vanilla JS |
| Alert() for confirmations | Blocks thread, ugly | Custom confirm component |
| Duplicating form code per module | Inconsistency, maintenance | PHP partials system |

### 19.4 Organizational Anti-Patterns

| Anti-Pattern | Problem | Alternative |
|---|---|---|
| Module-level CSS overriding global | Fragmentation | Extend via tokens, not overrides |
| Different form layouts per developer | Inconsistency | Enforce partial system |
| Adding new component types per feature | Design system inflation | Audit before adding |
| Removing accessibility for visual reasons | Legal and usability failure | Accessibility is non-negotiable |

---

## 20. ERP-SPECIFIC USABILITY RECOMMENDATIONS

### 20.1 Power User Efficiency

- **Tab order perfection:** Test every form with keyboard-only navigation. Any tab order violation is a bug.
- **Keyboard shortcuts (phase 2):** Common actions available via shortcuts: `Ctrl+S` = Save, `Escape` = Cancel, `Ctrl+N` = New record (in list context)
- **Search before select:** In all entity selection (driver, vehicle, contractor), default to searchable select with instant filtering. Never make the user scroll a list of 50 items.
- **Filter persistence:** Per-session filter state is preserved when returning to a table. Users should not re-filter after every navigation.

### 20.2 Long Session Optimization

- **Eye comfort:** Background is off-white, not pure white. Text is near-black, not pure black.
- **Motion: minimal.** No page-load animations. No scroll reveals. Subtle hover transitions (150ms) only.
- **Consistency creates flow:** When every form, every table, every button is in the same place, operators develop muscle memory and stop consciously reading the UI. This is the goal.

### 20.3 Error Recovery

- **Never lose data:** Failed saves must return the filled form with values intact. Zero tolerance for losing entered data.
- **Specific error messages:** "ИНН должен содержать 10 или 12 цифр" not "Неверный формат". Operator must know exactly what to fix.
- **Conflict resolution links:** When a soft warning involves another record ("Водитель уже в бригаде #8"), the warning must link directly to that record. No manual searching.

### 20.4 Document Workflow Optimization

- **Upload without edit mode:** Document upload must be possible without entering form edit mode. Operators frequently need to add documents to an existing record without touching other data.
- **Drag-and-drop everywhere:** Every upload zone supports both click and drag-and-drop. This is especially important for users with physical document scanners.
- **No file size surprises:** Maximum file size is shown before upload, not after failure.

### 20.5 Crew Dispatch Optimization (Future)

When trips are introduced:
- **Crew quick-select:** In trip creation, crew selection shows a rich preview (contractor + driver + vehicle + readiness) without opening each record.
- **Real-time availability:** A crew that is already on an active trip should be marked as unavailable in the crew selector.
- **One-screen dispatch:** Creating a trip dispatch order should require no more than one page, with all required information visible.

### 20.6 Data Integrity Without Blocking

The ERP's job is to support operations, not police them. Soft warnings are the primary tool for data quality. Hard blocks are reserved for genuine data integrity violations.

**The guiding principle:** A logistics operator in the field can always tell the system "I know better, let me through." The ERP records the state, issues the warning, and defers to human judgment.

---

## APPENDIX A — Form Field Checklist per Module

### Contractor Form Fields

| Field | Type | Required | Validation | Notes |
|---|---|---|---|---|
| Наименование | text | yes | not empty | DaData autofills from INN |
| Тип (ООО/ИП) | select | yes | — | Triggers OGRN/OGRNIP switch |
| ИНН | text | yes | 10 or 12 digits | Triggers DaData lookup on blur |
| ОГРН / ОГРНИП | text | yes | 13 or 15 digits | Depends on type |
| КПП | text | no | 9 digits | Hidden for ИП |
| Телефон | tel | yes | +7 mask | |
| Email | email | no | email format | |
| Юридический адрес | text | no | — | DaData autofills |
| Статус | toggle | yes | — | Default: active |
| Примечание | textarea | no | — | Full width |

### Driver Form Fields

| Field | Type | Required | Validation | Notes |
|---|---|---|---|---|
| Фамилия | text | yes | not empty | |
| Имя | text | yes | not empty | |
| Отчество | text | no | — | |
| Дата рождения | date | no | valid date | |
| Телефон | tel | yes | +7 mask | |
| Email | email | no | email format | |
| Серия ВУ | text | yes | format | |
| Номер ВУ | text | yes | 6 digits | |
| Категории | checkbox | no | — | А, B, C, D, E |
| Дата выдачи ВУ | date | no | valid date | |
| Дата окончания ВУ | date | no | > issue date | Warning if past |
| Контрагент | searchable-select | no | — | Operator may not know yet |
| Статус | toggle | yes | — | Default: active |

### Vehicle Form Fields

| Field | Type | Required | Validation | Notes |
|---|---|---|---|---|
| Гос. номер | text | yes | plate format | Auto-uppercase |
| Марка | text | yes | not empty | |
| Модель | text | no | — | |
| Год выпуска | text | no | 4 digits, reasonable range | |
| Тип ТС | select | yes | — | Грузовой/Тягач/Прицеп/etc. |
| Серия СТС | text | no | format | |
| Номер СТС | text | no | format | |
| Грузоподъёмность (т) | number | no | > 0 | |
| Объём кузова (м³) | number | no | > 0 | |
| Контрагент | searchable-select | no | — | |
| Статус | toggle | yes | — | Default: active |

### Crew Form Fields

| Field | Type | Required | Validation | Notes |
|---|---|---|---|---|
| Контрагент | searchable-select | yes | — | Filters driver/vehicle |
| Водитель | searchable-select | yes | — | Filtered by contractor |
| Транспортное средство | searchable-select | yes | — | Filtered by contractor |
| Дата начала | date | yes | valid date | |
| Дата окончания | date | no | > start date | Null = ongoing |
| Статус | toggle | yes | — | Default: active |
| Примечание | textarea | no | — | |

---

## APPENDIX B — Status Badge Reference

| Entity | Status Values | Badge Color |
|---|---|---|
| Contractor | Активен | green |
| Contractor | Неактивен | gray |
| Driver | Активен | green |
| Driver | Неактивен | gray |
| Driver | Лицензия истекла | amber |
| Vehicle | Активен | green |
| Vehicle | Неактивен | gray |
| Vehicle | ТО истекло | amber |
| Crew | Готов | green |
| Crew | Требует внимания | amber |
| Crew | Не готов | red |
| Crew | Неактивен | gray |
| Document | Загружен | green |
| Document | Отсутствует | red |
| Document | Истекает скоро | amber |
| Document | Истёк | red |

---

## APPENDIX C — Keyboard Navigation Reference

| Context | Key | Action |
|---|---|---|
| Form | Tab | Next field |
| Form | Shift+Tab | Previous field |
| Form | Enter | Submit (on single-line inputs) |
| Form | Escape | Cancel (if form is modal or panel) |
| Searchable Select | Arrow Up/Down | Navigate options |
| Searchable Select | Enter | Select focused option |
| Searchable Select | Escape | Close dropdown |
| Table | Arrow Up/Down | Navigate rows (phase 2) |
| Table | Enter | Open selected row |
| Confirmation Dialog | Enter | Confirm action |
| Confirmation Dialog | Escape | Cancel action |

---

*End of ERP UI/UX Architecture Document*
*Version: 1.0*
*Status: Strategy — Pre-implementation*
*Scope: Lightweight Transport/Logistics ERP — PHP/Vanilla JS/CSS*
