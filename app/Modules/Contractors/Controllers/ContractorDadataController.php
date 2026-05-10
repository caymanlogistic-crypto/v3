<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Controllers;

use App\Core\Controller;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Modules\Contractors\Services\ContractorDadataService;

final class ContractorDadataController extends Controller
{
    private ContractorDadataService $service;

    public function __construct()
    {
        $this->service = new ContractorDadataService();
    }

    public function lookup(Request $request): void
    {
        $inn = $request->input('inn', '');
        $inn = preg_replace('/\D/', '', $inn); // normalize to digits

        if (strlen($inn) !== 10 && strlen($inn) !== 12) {
            Response::json(['success' => false, 'message' => 'Некорректный ИНН']);
            return;
        }

        $data = $this->service->lookupByInn($inn);
        if (!$data) {
            Response::json(['success' => false, 'message' => 'Не удалось получить данные по ИНН. Заполните поля вручную.']);
            return;
        }

        Response::json(['success' => true, 'data' => $data]);
    }
}