<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Controllers;

use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Session\Flash;

use App\Modules\Contractors\Services\ContractorContactService;
use App\Modules\Contractors\Services\ContractorService;
use App\Modules\Contractors\Validation\ContractorValidator;

final class ContractorsController extends Controller
{
    private ContractorService $service;

    private ContractorValidator $validator;

    public function __construct()
    {
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

        $result = $this->service->paginate(
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
            'kpp' => trim((string) $request->input('kpp')),
            'ogrn' => trim((string) $request->input('ogrn')),
            'okved' => trim((string) $request->input('okved')),
            'legal_address' => trim((string) $request->input('legal_address')),
            'actual_address' => trim((string) $request->input('actual_address')),
            'director' => trim((string) $request->input('director')),
            'director_post' => trim((string) $request->input('director_post')),
            'contact1_name' => trim((string) $request->input('contact1_name')),
            'contact1_phone' => trim((string) $request->input('contact1_phone')),
            'contact1_email' => trim((string) $request->input('contact1_email')),
            'bank_name' => trim((string) $request->input('bank_name')),
            'bank_account' => trim((string) $request->input('bank_account')),
            'bank_corr_account' => trim((string) $request->input('bank_corr_account')),
            'bank_bik' => trim((string) $request->input('bank_bik')),
            'comments' => trim((string) $request->input('comments')),
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

        $this->service->create(
            $data
        );

        Flash::success(
            'Contractor created successfully'
        );

        Response::redirect(
            config('app.url') . '/contractors'
        );
    }

    public function edit(
        Request $request,
        array $params
    ): void {

        $contractor = $this->service->findById(
            (int) $params['id']
        );

        if (!$contractor) {

            Response::abort(
                404,
                'Contractor not found'
            );
        }

        $contactService = new ContractorContactService();

        $contacts = $contactService->findByContractorId(
            (int) $params['id']
        );

        $this->view(
            'contractors.edit',
            [
                'contractor' => $contractor,
                'errors' => [],
                'contacts' => $contacts,
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
            'kpp' => trim((string) $request->input('kpp')),
            'ogrn' => trim((string) $request->input('ogrn')),
            'okved' => trim((string) $request->input('okved')),
            'legal_address' => trim((string) $request->input('legal_address')),
            'actual_address' => trim((string) $request->input('actual_address')),
            'director' => trim((string) $request->input('director')),
            'director_post' => trim((string) $request->input('director_post')),
            'contact1_name' => trim((string) $request->input('contact1_name')),
            'contact1_phone' => trim((string) $request->input('contact1_phone')),
            'contact1_email' => trim((string) $request->input('contact1_email')),
            'bank_name' => trim((string) $request->input('bank_name')),
            'bank_account' => trim((string) $request->input('bank_account')),
            'bank_corr_account' => trim((string) $request->input('bank_corr_account')),
            'bank_bik' => trim((string) $request->input('bank_bik')),
            'comments' => trim((string) $request->input('comments')),
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

        $this->service->update(
            $id,
            $data
        );

        Flash::success(
            'Contractor updated successfully'
        );

        Response::redirect(
            config('app.url') . '/contractors'
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
            'Contractor deleted successfully'
        );

        Response::redirect(
            config('app.url') . '/contractors'
        );
    }
}
