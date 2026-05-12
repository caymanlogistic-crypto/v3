<?php

declare(strict_types=1);

namespace App\Modules\Crews\Controllers;

use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Session\Flash;
use App\Modules\Crews\Services\CrewService;
use App\Modules\Crews\Support\CrewInputMapper;
use App\Modules\Crews\Validation\CrewValidator;

final class CrewsController extends Controller
{
    private CrewService $service;

    private CrewValidator $validator;

    public function __construct()
    {
        $this->service = new CrewService();
        $this->validator = new CrewValidator();
    }

    public function index(Request $request): void
    {
        $page = max(1, (int) $request->input('page', 1));
        $search = trim((string) $request->input('search', ''));

        $result = $this->service->paginate($page, 20, $search);

        $this->view('crews.index', [
            'crews' => $result['data'],
            'pagination' => $result['pagination'],
            'search' => $search,
        ]);
    }

    public function create(Request $request): void
    {
        $this->view('crews.create', [
            'errors' => [],
            'warnings' => [],
            'old' => [
                'status' => 'active',
            ],
            'contractors' => $this->service->getContractorOptions(),
            'drivers' => $this->service->getDriverOptions(),
            'vehicles' => $this->service->getVehicleOptions(),
        ]);
    }

    public function store(Request $request): void
    {
        $rawData = [
            'contractor_id' => $request->input('contractor_id'),
            'driver_id' => $request->input('driver_id'),
            'vehicle_id' => $request->input('vehicle_id'),
            'status' => $request->input('status', 'active'),
            'comment' => $request->input('comment', ''),
        ];

        $data = CrewInputMapper::map($rawData);

        $errors = $this->validator->validate($data);

        if ((int) $data['contractor_id'] > 0 && !$this->service->contractorExists((int) $data['contractor_id'])) {
            $errors['contractor_id'] = "\u{0412}\u{044B}\u{0431}\u{0440}\u{0430}\u{043D}\u{043D}\u{044B}\u{0439} \u{043F}\u{043E}\u{0434}\u{0440}\u{044F}\u{0434}\u{0447}\u{0438}\u{043A} \u{043D}\u{0435} \u{043D}\u{0430}\u{0439}\u{0434}\u{0435}\u{043D}";
        }

        if ((int) $data['driver_id'] > 0 && !$this->service->driverExists((int) $data['driver_id'])) {
            $errors['driver_id'] = "\u{0412}\u{044B}\u{0431}\u{0440}\u{0430}\u{043D}\u{043D}\u{044B}\u{0439} \u{0432}\u{043E}\u{0434}\u{0438}\u{0442}\u{0435}\u{043B}\u{044C} \u{043D}\u{0435} \u{043D}\u{0430}\u{0439}\u{0434}\u{0435}\u{043D}";
        }

        if ((int) $data['vehicle_id'] > 0 && !$this->service->vehicleExists((int) $data['vehicle_id'])) {
            $errors['vehicle_id'] = "\u{0412}\u{044B}\u{0431}\u{0440}\u{0430}\u{043D}\u{043D}\u{0430}\u{044F} \u{043C}\u{0430}\u{0448}\u{0438}\u{043D}\u{0430} \u{043D}\u{0435} \u{043D}\u{0430}\u{0439}\u{0434}\u{0435}\u{043D}\u{0430}";
        }

        $warnings = $this->service->collectSoftWarnings(
            (int) $data['driver_id'],
            (int) $data['vehicle_id'],
            (string) $data['status']
        );

        if (!empty($errors)) {
            Flash::error('Validation failed');

            $this->view('crews.create', [
                'errors' => $errors,
                'warnings' => $warnings,
                'old' => $data,
                'contractors' => $this->service->getContractorOptions(),
                'drivers' => $this->service->getDriverOptions(),
                'vehicles' => $this->service->getVehicleOptions(),
            ]);

            return;
        }

        $crewId = $this->service->create($data);

        if (!empty($warnings)) {
            Flash::error(implode(' ', $warnings));
        } else {
            Flash::success("\u{0421}\u{0432}\u{044F}\u{0437}\u{043A}\u{0430} \u{0443}\u{0441}\u{043F}\u{0435}\u{0448}\u{043D}\u{043E} \u{0441}\u{043E}\u{0437}\u{0434}\u{0430}\u{043D}\u{0430}");
        }

        Response::redirect(config('app.url') . '/crews/' . $crewId . '/edit');
    }

    public function edit(Request $request, array $params): void
    {
        $id = (int) ($params['id'] ?? 0);
        $crew = $this->service->findById($id);

        if (!$crew) {
            Response::abort(404, 'Crew not found');
        }

        $warnings = $this->service->collectSoftWarnings(
            (int) ($crew['driver_id'] ?? 0),
            (int) ($crew['vehicle_id'] ?? 0),
            (string) ($crew['status'] ?? ''),
            $id
        );

        $this->view('crews.edit', [
            'crew' => $crew,
            'errors' => [],
            'warnings' => $warnings,
            'contractors' => $this->service->getContractorOptions(),
            'drivers' => $this->service->getDriverOptions(),
            'vehicles' => $this->service->getVehicleOptions(),
        ]);
    }

    public function update(Request $request, array $params): void
    {
        $id = (int) ($params['id'] ?? 0);

        $existingCrew = $this->service->findById($id);

        if (!$existingCrew) {
            Response::abort(404, 'Crew not found');
        }

        $rawData = [
            'contractor_id' => $request->input('contractor_id'),
            'driver_id' => $request->input('driver_id'),
            'vehicle_id' => $request->input('vehicle_id'),
            'status' => $request->input('status', 'active'),
            'comment' => $request->input('comment', ''),
        ];

        $data = CrewInputMapper::map($rawData);

        $errors = $this->validator->validate($data);

        if ((int) $data['contractor_id'] > 0 && !$this->service->contractorExists((int) $data['contractor_id'])) {
            $errors['contractor_id'] = "\u{0412}\u{044B}\u{0431}\u{0440}\u{0430}\u{043D}\u{043D}\u{044B}\u{0439} \u{043F}\u{043E}\u{0434}\u{0440}\u{044F}\u{0434}\u{0447}\u{0438}\u{043A} \u{043D}\u{0435} \u{043D}\u{0430}\u{0439}\u{0434}\u{0435}\u{043D}";
        }

        if ((int) $data['driver_id'] > 0 && !$this->service->driverExists((int) $data['driver_id'])) {
            $errors['driver_id'] = "\u{0412}\u{044B}\u{0431}\u{0440}\u{0430}\u{043D}\u{043D}\u{044B}\u{0439} \u{0432}\u{043E}\u{0434}\u{0438}\u{0442}\u{0435}\u{043B}\u{044C} \u{043D}\u{0435} \u{043D}\u{0430}\u{0439}\u{0434}\u{0435}\u{043D}";
        }

        if ((int) $data['vehicle_id'] > 0 && !$this->service->vehicleExists((int) $data['vehicle_id'])) {
            $errors['vehicle_id'] = "\u{0412}\u{044B}\u{0431}\u{0440}\u{0430}\u{043D}\u{043D}\u{0430}\u{044F} \u{043C}\u{0430}\u{0448}\u{0438}\u{043D}\u{0430} \u{043D}\u{0435} \u{043D}\u{0430}\u{0439}\u{0434}\u{0435}\u{043D}\u{0430}";
        }

        $warnings = $this->service->collectSoftWarnings(
            (int) $data['driver_id'],
            (int) $data['vehicle_id'],
            (string) $data['status'],
            $id
        );

        if (!empty($errors)) {
            Flash::error('Validation failed');

            $this->view('crews.edit', [
                'crew' => array_merge(['id' => $id], $data),
                'errors' => $errors,
                'warnings' => $warnings,
                'contractors' => $this->service->getContractorOptions(),
                'drivers' => $this->service->getDriverOptions(),
                'vehicles' => $this->service->getVehicleOptions(),
            ]);

            return;
        }

        $this->service->update($id, $data);

        if (!empty($warnings)) {
            Flash::error(implode(' ', $warnings));
        } else {
            Flash::success("\u{0421}\u{0432}\u{044F}\u{0437}\u{043A}\u{0430} \u{0443}\u{0441}\u{043F}\u{0435}\u{0448}\u{043D}\u{043E} \u{043E}\u{0431}\u{043D}\u{043E}\u{0432}\u{043B}\u{0435}\u{043D}\u{0430}");
        }

        Response::redirect(config('app.url') . '/crews');
    }

    public function delete(Request $request, array $params): void
    {
        $id = (int) ($params['id'] ?? 0);

        $crew = $this->service->findById($id);

        if (!$crew) {
            Response::abort(404, 'Crew not found');
        }

        $this->service->softDelete($id);

        Flash::success("\u{0421}\u{0432}\u{044F}\u{0437}\u{043A}\u{0430} \u{0443}\u{0434}\u{0430}\u{043B}\u{0435}\u{043D}\u{0430}");

        Response::redirect(config('app.url') . '/crews');
    }
}
