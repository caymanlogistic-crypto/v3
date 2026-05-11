<?php

declare(strict_types=1);

namespace App\Modules\Vehicles\Controllers;

use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Session\Flash;
use App\Modules\Vehicles\Services\VehicleFileService;
use App\Modules\Vehicles\Services\VehicleService;
use App\Modules\Vehicles\Support\VehicleInputMapper;
use App\Modules\Vehicles\Validation\VehicleValidator;

final class VehiclesController extends Controller
{
    private VehicleService $service;

    private VehicleFileService $fileService;

    private VehicleValidator $validator;

    public function __construct()
    {
        $this->service = new VehicleService();
        $this->fileService = new VehicleFileService();
        $this->validator = new VehicleValidator();
    }

    public function index(
        Request $request
    ): void {

        $page = max(
            1,
            (int) $request->input(
                'page',
                1
            )
        );

        $search = trim(
            (string) $request->input(
                'search',
                ''
            )
        );

        $result = $this->service->paginate(
            $page,
            20,
            $search
        );

        $this->view(
            'vehicles.index',
            [
                'vehicles' => $result['data'],
                'pagination' => $result['pagination'],
                'search' => $search,
            ]
        );
    }

    public function create(
        Request $request
    ): void {

        $this->view(
            'vehicles.create',
            [
                'errors' => [],
                'old' => [],
            ]
        );
    }

    public function store(
        Request $request
    ): void {

        $data = [
            'truck_brand' => trim((string) $request->input('truck_brand')),
            'truck_model' => trim((string) $request->input('truck_model')),
            'truck_plate' => trim((string) $request->input('truck_plate')),
            'truck_vin' => trim((string) $request->input('truck_vin')),
            'truck_load_capacity' => trim((string) $request->input('truck_load_capacity')),
            'truck_body_volume' => trim((string) $request->input('truck_body_volume')),
            'trailer_brand' => trim((string) $request->input('trailer_brand')),
            'trailer_model' => trim((string) $request->input('trailer_model')),
            'trailer_plate' => trim((string) $request->input('trailer_plate')),
            'trailer_vin' => trim((string) $request->input('trailer_vin')),
            'trailer_load_capacity' => trim((string) $request->input('trailer_load_capacity')),
            'trailer_body_volume' => trim((string) $request->input('trailer_body_volume')),
            'comments' => trim((string) $request->input('comments')),
            'status' => trim((string) $request->input('status')),
        ];

        $data = VehicleInputMapper::map($data);

        $errors = $this->validator->validate(
            $data
        );

        if (!empty($errors)) {
            Flash::error(
                'Validation failed'
            );

            $this->view(
                'vehicles.create',
                [
                    'errors' => $errors,
                    'old' => $data,
                ]
            );

            return;
        }

        $vehicleId = $this->service->create($data);

        Flash::success('Vehicle created successfully');

        Response::redirect(
            config('app.url') . '/vehicles/' . $vehicleId . '/edit'
        );
    }

    public function edit(
        Request $request,
        array $params
    ): void {

        $vehicle = $this->service->findById(
            (int) $params['id']
        );

        if (!$vehicle) {
            Response::abort(404, 'Vehicle not found');
        }

        $files = $this->fileService->findByVehicleId((int) $params['id']);

        $this->view(
            'vehicles.edit',
            [
                'vehicle' => $vehicle,
                'errors' => [],
                'files' => $files,
            ]
        );
    }

    public function update(
        Request $request,
        array $params
    ): void {

        $vehicleId = (int) $params['id'];

        $vehicle = $this->service->findById($vehicleId);

        if (!$vehicle) {
            Response::abort(404, 'Vehicle not found');
        }

        $data = [
            'truck_brand' => trim((string) $request->input('truck_brand')),
            'truck_model' => trim((string) $request->input('truck_model')),
            'truck_plate' => trim((string) $request->input('truck_plate')),
            'truck_vin' => trim((string) $request->input('truck_vin')),
            'truck_load_capacity' => trim((string) $request->input('truck_load_capacity')),
            'truck_body_volume' => trim((string) $request->input('truck_body_volume')),
            'trailer_brand' => trim((string) $request->input('trailer_brand')),
            'trailer_model' => trim((string) $request->input('trailer_model')),
            'trailer_plate' => trim((string) $request->input('trailer_plate')),
            'trailer_vin' => trim((string) $request->input('trailer_vin')),
            'trailer_load_capacity' => trim((string) $request->input('trailer_load_capacity')),
            'trailer_body_volume' => trim((string) $request->input('trailer_body_volume')),
            'comments' => trim((string) $request->input('comments')),
            'status' => trim((string) $request->input('status')),
        ];

        $data = VehicleInputMapper::map($data);

        $errors = $this->validator->validate(
            $data
        );

        if (!empty($errors)) {
            Flash::error(
                'Validation failed'
            );

            $files = $this->fileService->findByVehicleId($vehicleId);

            $this->view(
                'vehicles.edit',
                [
                    'vehicle' => array_merge(
                        ['id' => $vehicleId],
                        $data
                    ),
                    'errors' => $errors,
                    'files' => $files,
                ]
            );

            return;
        }

        $this->service->update($vehicleId, $data);

        Flash::success('Vehicle updated successfully');

        Response::redirect(
            config('app.url') . '/vehicles/' . $vehicleId . '/edit'
        );
    }

    public function delete(
        Request $request,
        array $params
    ): void {

        $vehicleId = (int) $params['id'];

        $vehicle = $this->service->findById($vehicleId);

        if (!$vehicle) {
            Response::abort(404, 'Vehicle not found');
        }

        $this->service->softDelete($vehicleId);

        Flash::success('Vehicle deleted successfully');

        Response::redirect(
            config('app.url') . '/vehicles'
        );
    }
}
