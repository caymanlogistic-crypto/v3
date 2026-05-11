<?php

declare(strict_types=1);

namespace App\Modules\Vehicles\Controllers;

use App\Core\Auth\Auth;
use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Session\Flash;
use App\Modules\Vehicles\Services\VehicleFileService;
use App\Modules\Vehicles\Support\VehicleFileStorage;
use App\Modules\Vehicles\Validation\VehicleFileValidator;

final class VehicleFilesController extends Controller
{
    private VehicleFileService $service;

    private VehicleFileValidator $validator;

    public function __construct()
    {
        $this->service = new VehicleFileService();
        $this->validator = new VehicleFileValidator();
    }

    public function upload(Request $request, array $params): void
    {
        $vehicleId = (int) $params['id'];
        $successCount = 0;
        $errorCount = 0;

        $typedFiles = $this->normalizeUploadedFilesByType($_FILES, 'typed_files');

        if ($typedFiles !== []) {
            $comments = isset($_POST['comments']) && is_array($_POST['comments']) ? $_POST['comments'] : [];

            foreach ($typedFiles as $fileType => $files) {
                $currentFileType = trim((string) $fileType);
                $comment = trim((string) ($comments[$currentFileType] ?? ''));

                foreach ($files as $file) {
                    if ($this->saveUploadedFile($vehicleId, $currentFileType, $comment, $file)) {
                        $successCount++;
                    } else {
                        $errorCount++;
                    }
                }
            }
        } else {
            $currentFileType = trim((string) $request->input('file_type'));
            $comment = trim((string) $request->input('comment'));
            $uploadedFiles = $this->normalizeUploadedFiles($_FILES);

            if ($uploadedFiles === []) {
                Flash::error('Файл не выбран');
                Response::redirect(config('app.url') . '/vehicles/' . $vehicleId . '/edit');
            }

            foreach ($uploadedFiles as $file) {
                if ($this->saveUploadedFile($vehicleId, $currentFileType, $comment, $file)) {
                    $successCount++;
                } else {
                    $errorCount++;
                }
            }
        }

        if ($successCount > 0 && $errorCount === 0) {
            Flash::success('Успешно загружено файлов: ' . $successCount);
        } elseif ($successCount > 0) {
            Flash::error('Загружено файлов: ' . $successCount . '. Ошибок: ' . $errorCount);
        } else {
            Flash::error('Не удалось загрузить файлы');
        }

        Response::redirect(config('app.url') . '/vehicles/' . $vehicleId . '/edit');
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

        $vehicleId = (int) $file['vehicle_id'];

        VehicleFileStorage::deleteFile((string) $file['file_path']);
        $this->service->softDelete($fileId);

        Flash::success('Файл удалён');

        Response::redirect(
            config('app.url') . '/vehicles/' . $vehicleId . '/edit'
        );
    }

    /**
     * @param array{name:string,type:string,tmp_name:string,error:int,size:int} $file
     */
    private function saveUploadedFile(int $vehicleId, string $fileType, string $comment, array $file): bool
    {
        $data = [
            'file_type' => $fileType,
            'comment' => $comment,
        ];

        $errors = $this->validator->validate($data, $file);

        if (!empty($errors)) {
            return false;
        }

        try {
            $storage = VehicleFileStorage::moveUploadedFile($file, $vehicleId);

            $mimeType = $file['type'] ?? 'application/octet-stream';
            if (empty($mimeType) && is_file($storage['file_path'])) {
                $mimeType = mime_content_type($storage['file_path']) ?: 'application/octet-stream';
            }

            $this->service->create($vehicleId, [
                'original_name' => (string) $file['name'],
                'stored_name' => $storage['stored_name'],
                'file_path' => $storage['file_path'],
                'mime_type' => $mimeType,
                'file_extension' => strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION)),
                'file_size' => (int) $file['size'],
                'file_type' => $fileType,
                'uploaded_by' => Auth::id(),
                'comment' => $comment,
            ]);

            return true;
        } catch (\Throwable $exception) {
            return false;
        }
    }

    /**
     * @param array<string, mixed> $files
     * @return array<int, array{name:string,type:string,tmp_name:string,error:int,size:int}>
     */
    private function normalizeUploadedFiles(array $files): array
    {
        $normalized = [];
        $rawFiles = $files['files'] ?? $files['file'] ?? null;

        if (!is_array($rawFiles)) {
            return [];
        }

        if (isset($rawFiles['name']) && is_array($rawFiles['name'])) {
            $count = count($rawFiles['name']);

            for ($index = 0; $index < $count; $index++) {
                $file = [
                    'name' => (string) ($rawFiles['name'][$index] ?? ''),
                    'type' => (string) ($rawFiles['type'][$index] ?? ''),
                    'tmp_name' => (string) ($rawFiles['tmp_name'][$index] ?? ''),
                    'error' => (int) ($rawFiles['error'][$index] ?? UPLOAD_ERR_NO_FILE),
                    'size' => (int) ($rawFiles['size'][$index] ?? 0),
                ];

                if ($file['error'] === UPLOAD_ERR_NO_FILE || $file['name'] === '') {
                    continue;
                }

                $normalized[] = $file;
            }

            return $normalized;
        }

        $file = [
            'name' => (string) ($rawFiles['name'] ?? ''),
            'type' => (string) ($rawFiles['type'] ?? ''),
            'tmp_name' => (string) ($rawFiles['tmp_name'] ?? ''),
            'error' => (int) ($rawFiles['error'] ?? UPLOAD_ERR_NO_FILE),
            'size' => (int) ($rawFiles['size'] ?? 0),
        ];

        if ($file['error'] === UPLOAD_ERR_NO_FILE || $file['name'] === '') {
            return [];
        }

        $normalized[] = $file;

        return $normalized;
    }

    /**
     * @param array<string, mixed> $files
     * @return array<string, array<int, array{name:string,type:string,tmp_name:string,error:int,size:int}>>
     */
    private function normalizeUploadedFilesByType(array $files, string $rootKey): array
    {
        $raw = $files[$rootKey] ?? null;
        $result = [];

        if (!is_array($raw) || !isset($raw['name']) || !is_array($raw['name'])) {
            return $result;
        }

        foreach ($raw['name'] as $fileType => $names) {
            if (!is_array($names)) {
                continue;
            }

            foreach ($names as $index => $name) {
                $file = [
                    'name' => (string) $name,
                    'type' => (string) ($raw['type'][$fileType][$index] ?? ''),
                    'tmp_name' => (string) ($raw['tmp_name'][$fileType][$index] ?? ''),
                    'error' => (int) ($raw['error'][$fileType][$index] ?? UPLOAD_ERR_NO_FILE),
                    'size' => (int) ($raw['size'][$fileType][$index] ?? 0),
                ];

                if ($file['error'] === UPLOAD_ERR_NO_FILE || $file['name'] === '') {
                    continue;
                }

                $typeKey = (string) $fileType;
                if (!isset($result[$typeKey])) {
                    $result[$typeKey] = [];
                }

                $result[$typeKey][] = $file;
            }
        }

        return $result;
    }
}