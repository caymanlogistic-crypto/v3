# DEVELOPMENT_WORKFLOW.md

## Current Workflow

Architecture
→ implementation plan
→ Copilot prompt
→ Copilot implementation
→ review
→ hotfix
→ commit
→ push
→ server git pull
→ runtime verification

## Git Workflow

git add .
git commit -m "..."
git push

Server:
git pull

## Validation Workflow

Request
→ InputMapper
→ Validator
→ Save

Frontend validation:
- UX helper only

Backend validation:
- authoritative

## Copilot Rules

Copilot must:
- preserve runtime behavior
- avoid overengineering
- avoid framework drift
- preserve lightweight ERP architecture