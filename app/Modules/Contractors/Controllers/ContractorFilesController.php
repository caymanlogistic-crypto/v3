<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Controllers;

use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Session\Flash;
use App\Modules\Contractors\Services\ContractorFileService;
use App\Modules\Contractors\Support\ContractorFileStorage;
use App\Modules\Contractors\Validation\ContractorFileValidator;

final class ContractorFilesController extends Controller
{
    private ContractorFileService $service;

    private ContractorFileValidator $validator;

    public function __construct()
    {
        $this->service = new ContractorFileService();
        $this->validator = new ContractorFileValidator();
    }

    public function upload(Request $request, array $params): void
    {
        $contractorId = (int) $params['id'];

        $data = [
            'file_type' => trim((string) $request->input('file_type')),
            'comment' => trim((string) $request->input('comment')),
        ];

        $file = $_FILES['file'] ?? [];

        $errors = $this->validator->validate($data, $file);

        if (!empty($errors)) {
            Flash::error('Ошибка загрузки файла');

            Response::redirect(
                config('app.url') . '/contractors/' . $contractorId . '/edit'
            );
        }

        try {
            $storage = ContractorFileStorage::moveUploadedFile($file, $contractorId);

            $mimeType = $file['type'] ?? 'application/octet-stream';
            if (empty($mimeType) && is_file($storage['file_path'])) {
                $mimeType = mime_content_type($storage['file_path']) ?: 'application/octet-stream';
            }

            $this->service->create($contractorId, [
                'original_name' => (string) $file['name'],
                'stored_name' => $storage['stored_name'],
                'file_path' => $storage['file_path'],
                'mime_type' => $mimeType,
                'file_extension' => strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION)),
                'file_size' => (int) $file['size'],
                'comment' => $data['comment'],
            ]);

            Flash::success('Файл успешно загружен');
        } catch (\Throwable $exception) {
            Flash::error('Не удалось сохранить файл');
        }

        Response::redirect(
            config('app.url') . '/contractors/' . $contractorId . '/edit'
        );
    }

    public function download(Request $request, array $params): void
    {
        $fileId = (int) $params['id'];

        $file = $this->service->findById($fileId);

        if (!$file || empty($file['file_path'])) {
            Response::abort(404, 'File not found');
        }

        $path = $file['file_path'];

        if (!is_file($path)) {
            Response::abort(404, 'File not found');
        }

        $originalName = $file['original_name'] ?? 'file';
        $mimeType = $file['mime_type'] ?: 'application/octet-stream';
        $fileSize = isset($file['file_size']) ? (int) $file['file_size'] : filesize($path);

        header('Content-Description: File Transfer');
        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: attachment; filename="' . rawurlencode($originalName) . '"');
        header('Content-Length: ' . $fileSize);
        header('Pragma: public');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        readfile($path);
        exit;
    }

    public function delete(Request $request, array $params): void
    {
        $fileId = (int) $params['id'];

        $file = $this->service->findById($fileId);

        if (!$file) {
            Response::abort(404, 'File not found');
        }

        $contractorId = (int) $file['contractor_id'];

        ContractorFileStorage::deleteFile((string) $file['file_path']);
        $this->service->softDelete($fileId);

        Flash::success('Файл удалён');

        Response::redirect(
            config('app.url') . '/contractors/' . $contractorId . '/edit'
        );
    }
}
