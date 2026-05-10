<?php

declare(strict_types=1);

namespace App\Modules\Drivers\Controllers;

use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Session\Flash;
use App\Modules\Drivers\Services\DriverService;
use App\Modules\Drivers\Support\DriverInputMapper;
use App\Modules\Drivers\Validation\DriverValidator;

final class DriversController extends Controller
{
    private DriverService $service;

    private DriverValidator $validator;

    public function __construct()
    {
        $this->service = new DriverService();

        $this->validator = new DriverValidator();
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
            'drivers.index',
            [
                'drivers' => $result['data'],
                'pagination' => $result['pagination'],
                'search' => $search,
            ]
        );
    }

    public function create(
        Request $request
    ): void {

        $this->view(
            'drivers.create',
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
            'full_name' => trim((string) $request->input('full_name')),
            'phone' => trim((string) $request->input('phone')),
            'email' => trim((string) $request->input('email')),
            'passport_number' => trim((string) $request->input('passport_number')),
            'passport_issue_date' => trim((string) $request->input('passport_issue_date')),
            'passport_issued_by' => trim((string) $request->input('passport_issued_by')),
            'license_number' => trim((string) $request->input('license_number')),
            'license_issue_date' => trim((string) $request->input('license_issue_date')),
            'snils' => trim((string) $request->input('snils')),
            'comments' => trim((string) $request->input('comments')),
            'status' => trim((string) $request->input('status')),
        ];

        $data = DriverInputMapper::map($data);

        $errors = $this->validator->validate(
            $data
        );

        if (!empty($errors)) {

            Flash::error(
                'Validation failed'
            );

            $this->view(
                'drivers.create',
                [
                    'errors' => $errors,
                    'old' => $data,
                ]
            );

            return;
        }

        $driverId = $this->service->create(
            $data
        );

        Flash::success(
            'Driver created successfully'
        );

        Response::redirect(
            config('app.url') . '/drivers/' . $driverId . '/edit'
        );
    }

    public function edit(
        Request $request,
        array $params
    ): void {

        $driver = $this->service->findById(
            (int) $params['id']
        );

        if (!$driver) {

            Response::abort(
                404,
                'Driver not found'
            );
        }

        $this->view(
            'drivers.edit',
            [
                'driver' => $driver,
                'errors' => [],
            ]
        );
    }

    public function update(
        Request $request,
        array $params
    ): void {

        $id = (int) $params['id'];

        $data = [
            'full_name' => trim((string) $request->input('full_name')),
            'phone' => trim((string) $request->input('phone')),
            'email' => trim((string) $request->input('email')),
            'passport_number' => trim((string) $request->input('passport_number')),
            'passport_issue_date' => trim((string) $request->input('passport_issue_date')),
            'passport_issued_by' => trim((string) $request->input('passport_issued_by')),
            'license_number' => trim((string) $request->input('license_number')),
            'license_issue_date' => trim((string) $request->input('license_issue_date')),
            'snils' => trim((string) $request->input('snils')),
            'comments' => trim((string) $request->input('comments')),
            'status' => trim((string) $request->input('status')),
        ];

        $data = DriverInputMapper::map($data);

        $errors = $this->validator->validate(
            $data
        );

        if (!empty($errors)) {

            Flash::error(
                'Validation failed'
            );

            $this->view(
                'drivers.edit',
                [
                    'driver' => array_merge(
                        ['id' => $id],
                        $data
                    ),
                    'errors' => $errors,
                ]
            );

            return;
        }

        $this->service->update(
            $id,
            $data
        );

        Flash::success(
            'Driver updated successfully'
        );

        Response::redirect(
            config('app.url') . '/drivers'
        );
    }

    public function delete(
        Request $request,
        array $params
    ): void {

        $this->service->softDelete(
            (int) $params['id']
        );

        Flash::success(
            'Driver deleted successfully'
        );

        Response::redirect(
            config('app.url') . '/drivers'
        );
    }
}
