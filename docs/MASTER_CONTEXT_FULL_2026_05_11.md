
# MASTER CONTEXT FULL — TRANSPORT ERP v3
# Updated: 2026-05-11

Transport ERP v3 is a lightweight modular transport/logistics ERP platform.

Current implemented modules:
- Contractors
- Drivers
- Vehicles

All modules now include:
- CRUD
- validation
- realtime validation
- InputMapper normalization
- file subsystems
- upload/download/delete
- soft delete
- compact ERP workflows

Current architecture pattern:

Request
→ InputMapper
→ Validator
→ Repository
→ Service
→ Controller
→ View

Frontend validation:
- UX helper only

Backend validation:
- authoritative

Vehicle model:
truck + optional trailer combination

Storage:
/storage/uploads/contractors
/storage/uploads/drivers
/storage/uploads/vehicles

Files are NOT public.

Use:
config('app.url')

Never use:
window.location.origin
/v3/public hardcoding

Critical hallucinations to avoid:
- Flash::setOld()
- Flash::getOld()
- Flash::setError()
- redirectBack()
- back()
- Paginator::build()
- previousPage()
- nextPage()
- currentPage()
- lastPage()

Correct controller import:
use App\Core\Controller\Controller;

Wrong:
use App\Core\Controller;

Do not report completed unless:
- git add succeeded
- git commit succeeded
- git push succeeded
- git status clean
- branch up to date with origin

Current next phase:
- operational linking layer
- contractor_drivers
- contractor_vehicles
- driver_vehicle_assignments
