<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Controllers;

use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Session\Flash;
use App\Modules\Contractors\Services\ContractorContactService;
use App\Modules\Contractors\Validation\ContractorContactValidator;

final class ContractorContactsController extends Controller
{
    private ContractorContactService $service;

    private ContractorContactValidator $validator;

    public function __construct()
    {
        $this->service = new ContractorContactService();
        $this->validator = new ContractorContactValidator();
    }

    public function store(Request $request, array $params): void
    {
        $contractorId = (int) $params['id'];

        $data = [
            'full_name' => trim((string) $request->input('full_name')),
            'position' => trim((string) $request->input('position')),
            'role' => trim((string) $request->input('role')),
            'phone' => trim((string) $request->input('phone')),
            'email' => trim((string) $request->input('email')),
            'is_primary' => $request->has('is_primary') ? 1 : 0,
            'is_payment_recipient' => $request->has('is_payment_recipient') ? 1 : 0,
            'is_document_recipient' => $request->has('is_document_recipient') ? 1 : 0,
            'status' => trim((string) $request->input('status')),
            'comment' => trim((string) $request->input('comment')),
        ];

        $errors = $this->validator->validate($data);

        if (!empty($errors)) {
            Flash::error('Validation failed');

            Response::redirect(
                config('app.url') . '/contractors/' . $contractorId . '/edit'
            );
        }

        $this->service->create($contractorId, $data);

        Flash::success('Contact added successfully');

        Response::redirect(
            config('app.url') . '/contractors/' . $contractorId . '/edit'
        );
    }

    public function update(Request $request, array $params): void
    {
        $contactId = (int) $params['id'];

        $contact = $this->service->findById($contactId);

        if (!$contact) {
            Response::abort(404, 'Contact not found');
        }

        $contractorId = (int) $contact['contractor_id'];

        $data = [
            'full_name' => trim((string) $request->input('full_name')),
            'position' => trim((string) $request->input('position')),
            'role' => trim((string) $request->input('role')),
            'phone' => trim((string) $request->input('phone')),
            'email' => trim((string) $request->input('email')),
            'is_primary' => $request->has('is_primary') ? 1 : 0,
            'is_payment_recipient' => $request->has('is_payment_recipient') ? 1 : 0,
            'is_document_recipient' => $request->has('is_document_recipient') ? 1 : 0,
            'status' => trim((string) $request->input('status')),
            'comment' => trim((string) $request->input('comment')),
        ];

        $errors = $this->validator->validate($data);

        if (!empty($errors)) {
            Flash::error('Validation failed');

            Response::redirect(
                config('app.url') . '/contractors/' . $contractorId . '/edit'
            );
        }

        $this->service->update($contactId, $data);

        Flash::success('Contact updated successfully');

        Response::redirect(
            config('app.url') . '/contractors/' . $contractorId . '/edit'
        );
    }

    public function delete(Request $request, array $params): void
    {
        $contactId = (int) $params['id'];

        $contact = $this->service->findById($contactId);

        if (!$contact) {
            Response::abort(404, 'Contact not found');
        }

        $contractorId = (int) $contact['contractor_id'];

        $this->service->softDelete($contactId);

        Flash::success('Contact deleted successfully');

        Response::redirect(
            config('app.url') . '/contractors/' . $contractorId . '/edit'
        );
    }
}
