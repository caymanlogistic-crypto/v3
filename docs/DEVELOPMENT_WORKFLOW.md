# Development Workflow

## AI Toolchain and Roles

### Claude
Role: deep reviewer, edge-case analyst, architect coordinator, risk analyst

Responsibilities:
- analyze code before implementation
- generate optimized prompts for Copilot
- review Copilot output before commit
- identify hallucinations and runtime risks
- generate hotfixes when Copilot produces invalid code
- update documentation after implementation cycles

### GitHub Copilot
Role: primary implementation engine

Responsibilities:
- CRUD generation, repetitive code, form fields, views
- multi-file changes within current architecture
- follows `.github/copilot-instructions.md` automatically
- requires `docs/COPILOT_API_REFERENCE.md` to prevent method hallucination

Limitations:
- hallucinates methods without explicit API reference
- must be reviewed by Claude before committing
- does not have reliable long-term memory — context loaded via instructions file

### ChatGPT
Role: chief architect, stabilization advisor, ERP planner

Responsibilities:
- architecture decisions
- complex reasoning and planning
- documentation governance
- stabilization strategy

### Local Codex
Role: heavy refactor specialist

Responsibilities:
- batch transformations
- multi-file namespace migrations
- repetitive scaffolding

### Git / GitHub
Role: source of truth

Workflow:
```
local changes → git add → git commit → git push → server git pull → verify runtime
```

Production changes must never be made directly on server without Git sync.

---

## Copilot Prompt Workflow

For every Copilot implementation task:

1. Claude analyzes the task and identifies risks
2. Claude generates a scoped prompt with:
   - explicit docs to read (`#file:docs/...`)
   - forbidden behaviors
   - available methods from `docs/COPILOT_API_REFERENCE.md`
   - exact files to modify
   - before/after expectations
3. Developer runs prompt in Copilot Chat
4. Developer sends result to Claude for review
5. Claude identifies issues (hallucinated methods, wrong patterns)
6. Developer applies fixes or Claude generates hotfix
7. Commit only after Claude review passes

---

## Copilot Hallucination Prevention

Two layers of protection:

**Layer 1 — Auto-loaded context:**
`.github/copilot-instructions.md` is automatically read by Copilot Chat in VS Code on every new chat session. Contains project rules, forbidden behaviors, and doc reading list.

**Layer 2 — Explicit API reference:**
`docs/COPILOT_API_REFERENCE.md` lists every available method for core classes. Copilot prompts must reference this file. Never assume Copilot knows what methods exist.

Known hallucinated methods (never use):
- `Flash::setOld()`, `Flash::getOld()`, `Flash::setError()`, `Flash::set()`, `Flash::get()`
- Any method not listed in `docs/COPILOT_API_REFERENCE.md`

---

## Git Workflow

```powershell
# Stage specific files
git add path/to/file.php

# Commit with clear message
git commit -m "fix(module): description of change"

# Push to GitHub
git push

# Deploy on server
git pull
```

Commit message format: `type(scope): description`
Types: `fix`, `feat`, `docs`, `refactor`

---

## Deployment Workflow

- Shared hosting via git pull
- Server PHP: php8.4
- Document root: `public/`
- After pull: verify runtime in browser
- Logs: `storage/logs/`

---

## Debugging Workflow

1. Read error message and file:line reference
2. Check actual file content (don't assume)
3. Identify root cause (missing import, wrong method, etc.)
4. Apply minimal targeted fix
5. Commit and verify on server

Common issues found:
- Missing `use` statements in PHP classes
- Fully qualified class names required in view files
- Copilot hallucinating non-existent methods
