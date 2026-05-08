<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Controllers;

use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Session\Flash;

use App\Modules\Contractors\Repositories\ContractorRepository;
use App\Modules\Contractors\Services\ContractorService;
use App\Modules\Contractors\Validation\ContractorValidator;

final class ContractorsController extends Controller
{
    private ContractorRepository $repository;

    private ContractorService $service;

    private ContractorValidator $validator;

    public function __construct()
    {
        $this->repository = new ContractorRepository();

        $this->service = new ContractorService();

        $this->validator = new ContractorValidator();
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

        $result = $this->repository->paginate(
            $page,
            20,
            $search
        );

        $this->view(
            'contractors.index',
            [
                'contractors' => $result['data'],
                'pagination' => $result['pagination'],
                'search' => $search,
            ]
        );
    }

    public function create(
        Request $request
    ): void {

        $this->view(
            'contractors.create',
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
            'name' => trim((string) $request->input('name')),
            'inn' => trim((string) $request->input('inn')),
            'contact1_phone' => trim((string) $request->input('contact1_phone')),
            'contact1_email' => trim((string) $request->input('contact1_email')),
            'legal_address' => trim((string) $request->input('legal_address')),
            'status' => trim((string) $request->input('status')),
        ];

        $errors = $this->validator->validate(
            $data
        );

        if (!empty($errors)) {

            Flash::error(
                'Validation failed'
            );

            $this->view(
                'contractors.create',
                [
                    'errors' => $errors,
                    'old' => $data,
                ]
            );

            return;
        }

        $this->repository->create(
            $data
        );

        Flash::success(
            'Contractor created successfully'
        );

        Response::redirect(
            '/v3/public/contractors'
        );
    }

    public function edit(
        Request $request,
        array $params
    ): void {

        $contractor = $this->repository->findById(
            (int) $params['id']
        );

        if (!$contractor) {

            Response::abort(
                404,
                'Contractor not found'
            );
        }

        $this->view(
            'contractors.edit',
            [
                'contractor' => $contractor,
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
            'name' => trim((string) $request->input('name')),
            'inn' => trim((string) $request->input('inn')),
            'contact1_phone' => trim((string) $request->input('contact1_phone')),
            'contact1_email' => trim((string) $request->input('contact1_email')),
            'legal_address' => trim((string) $request->input('legal_address')),
            'status' => trim((string) $request->input('status')),
        ];

        $errors = $this->validator->validate(
            $data
        );

        if (!empty($errors)) {

            Flash::error(
                'Validation failed'
            );

            $this->view(
                'contractors.edit',
                [
                    'contractor' => array_merge(
                        ['id' => $id],
                        $data
                    ),
                    'errors' => $errors,
                ]
            );

            return;
        }

        $this->repository->update(
            $id,
            $data
        );

        Flash::success(
            'Contractor updated successfully'
        );

        Response::redirect(
            '/v3/public/contractors'
        );
    }

    public function delete(
        Request $request,
        array $params
    ): void {

        $this->repository->softDelete(
            (int) $params['id']
        );

        Flash::success(
            'Contractor deleted successfully'
        );

        Response::redirect(
            '/v3/public/contractors'
        );
    }
}
