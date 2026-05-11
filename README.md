# TRANSPORT ERP v3

Lightweight modular transport/logistics ERP platform built on a custom PHP core.

---

# Project Overview

Transport ERP v3 is a stabilization-first operational ERP system focused on:

* transport logistics
* contractors
* drivers
* vehicles
* operational document workflows
* logistics onboarding
* runtime-safe modular architecture

The project is designed for:

* PHP 8.4
* shared hosting
* MySQL + PDO
* desktop-first operational workflows
* lightweight runtime behavior

---

# Current Implemented Modules

## Contractors

* CRUD
* contractor contacts
* contractor files
* DaData autofill by INN
* realtime validation
* InputMapper normalization
* grouped multiple uploads
* operational upload workflow

## Drivers

* CRUD
* driver files
* realtime validation
* human-friendly dates
* grouped multiple uploads
* operational upload workflow

## Vehicles

* CRUD
* vehicle files
* truck + optional trailer model
* trailer documents
* truck/trailer photos
* grouped multiple uploads
* operational upload workflow

---

# Current UX Features

Implemented:

* global ERP form UX system
* tooltips and hints
* realtime validation
* human-friendly normalization
* keyboard-layout correction
* grouped Upload workflow
* hide completed document blocks
* compact desktop-first ERP UI

Examples:

```text id="jlwmhk"
K816XK147 → К816ХК147
```

```text id="’winihl"
иванов иван иванович → Иванов Иван Иванович
```

```text id="jlwmin"
8 (999) 123-45-67 → +7 (999) 123-45-67
```

---

# Architecture Summary

## Core

```text id="jlwmio"
app/Core
```

Contains:

* Router
* Middleware
* Auth
* RBAC
* Flash
* Validation helpers
* View rendering
* Pagination
* Exception handling

## Modules

```text id="jwmwip"
app/Modules
```

Each module contains:

* Controllers
* Repositories
* Services
* Validation
* Support
* DTO (optional)

## Views

```text id="jlwmiq"
app/Views
```

Desktop-first compact ERP views.

---

# Runtime Philosophy

Main project philosophy:

```text id="jlwmir"
predictable boring stability
```

over:

```text id="jlwmis"
architectural purity
```

This project intentionally avoids:

* Laravel rewrite
* Symfony rewrite
* ORM migration
* SPA frontend
* overengineering
* framework-style abstractions

---

# Storage Structure

```text id="jlwmit"
/storage/uploads/contractors
/storage/uploads/drivers
/storage/uploads/vehicles
```

Files are NOT public.

Downloads always go through backend controllers.

---

# File Workflow

Operational upload UX:

* multiple file upload
* grouped Upload button
* predefined operational upload blocks
* completed required document blocks disappear
* `other` uploads always available

Examples:

Contractors:

* contract
* company card
* other

Drivers:

* passport
* license
* snils
* other

Vehicles:

* sts
* diagnostic card
* trailer sts
* trailer diagnostic card
* truck photo
* trailer photo
* other

---

# Current Validation / Mapping

Implemented:

* InputMapper normalization
* realtime frontend validation
* authoritative backend validation
* UTF-8 normalization
* Excel-tolerant input handling

Accepted formats:

* human-friendly dates
* multiple phone formats
* keyboard layout correction
* multiple decimal formats

---

# Deployment

## Shared hosting

The project is designed for shared hosting deployment.

## Public entrypoint

```text id="jlwmiu"
public/index.php
```

## Server PHP

Use:

```bash id="jlwmiv"
php8.4
```

## Local Windows environment

Use:

```bash id="jlwmiw"
php
```

---

# Git Workflow

```text id="jlwmix"
local changes
→ git add
→ git commit
→ git push
→ server git pull
→ runtime verification
```

---

# AI Toolchain

## ChatGPT / Claude

Used for:

* architecture
* stabilization
* ERP planning
* runtime review
* anti-hallucination guidance

## GitHub Copilot

Primary implementation engine.

## Local Codex

Used for:

* heavy scaffolding
* multi-file implementation
* repetitive operational tasks

---

# AI Safety Rules

Never invent methods.

Use ONLY methods documented in:

```text id="jlwmiy"
docs/COPILOT_API_REFERENCE.md
```

Known hallucination risks:

* fake paginator methods
* wrong controller imports
* window.location.origin
* hardcoded /v3/public
* false push completion reports

---

# Important Documentation

Main runtime truth layer:

```text id="jlwmiz"
docs/MASTER_CONTEXT.md
```

Expanded Russian operational context:

```text id="jlwmj0"
docs/RUSSIAN_MASTER_DOCS_ERP_V3.md
```

Additional:

* AI_RULES.md
* AI_CONTEXT_RULES.md
* UI_GUIDELINES.md
* DEVELOPMENT_WORKFLOW.md
* MODULE_STANDARDS.md

---

# Current Stage

Current stage:

```text id="jlwmj1"
real operational ERP stabilization
```

Current next phase:

* operational linking layer
* contractor_drivers
* contractor_vehicles
* driver_vehicle_assignments
* tandem onboarding workflow
