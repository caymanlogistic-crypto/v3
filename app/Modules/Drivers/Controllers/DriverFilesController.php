<?php

declare(strict_types=1);

namespace App\Modules\Drivers\Controllers;

use App\Core\Auth\Auth;
use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Session\Flash;
use App\Modules\Drivers\Services\DriverFileService;
use App\Modules\Drivers\Support\DriverFileStorage;
use App\Modules\Drivers\Validation\DriverFileValidator;

final class DriverFilesController extends Controller
{
    private DriverFileService $service;

    private DriverFileValidator $validator;

    public function __construct()
    {
        $this->service = new DriverFileService();
        $this->validator = new DriverFileValidator();
    }

    public function upload(Request $request, array $params): void
    {
        $driverId = (int) $params['id'];

        $data = [
            'file_type' => trim((string) $request->input('file_type')),
            'comment' => trim((string) $request->input('comment')),
        ];

        $file = $_FILES['file'] ?? [];

        $errors = $this->validator->validate($data, $file);

        if (!empty($errors)) {
            Flash::error('Ошибка загрузки файла');

            Response::redirect(
                config('app.url') . '/drivers/' . $driverId . '/edit'
            );
        }

        try {
            $storage = DriverFileStorage::moveUploadedFile($file, $driverId);

            $mimeType = $file['type'] ?? 'application/octet-stream';
            if (empty($mimeType) && is_file($storage['file_path'])) {
                $mimeType = mime_content_type($storage['file_path']) ?: 'application/octet-stream';
            }

            $this->service->create($driverId, [
                'original_name' => (string) $file['name'],
                'stored_name' => $storage['stored_name'],
                'file_path' => $storage['file_path'],
                'mime_type' => $mimeType,
                'file_extension' => strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION)),
                'file_size' => (int) $file['size'],
                'file_type' => $data['file_type'],
                'uploaded_by' => Auth::id(),
                'comment' => $data['comment'],
            ]);

            Flash::success('Файл успешно загружен');
        } catch (\Throwable $exception) {
            Flash::error('Не удалось сохранить файл');
        }

        Response::redirect(
            config('app.url') . '/drivers/' . $driverId . '/edit'
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

        $driverId = (int) $file['driver_id'];

        DriverFileStorage::deleteFile((string) $file['file_path']);
        $this->service->softDelete($fileId);

        Flash::success('Файл удалён');

        Response::redirect(
            config('app.url') . '/drivers/' . $driverId . '/edit'
        );
    }
}
