<?php

declare(strict_types=1);

namespace App\Modules\Vehicles\Support;

final class VehicleFileStorage
{
    public static function moveUploadedFile(array $file, int $vehicleId): array
    {
        $directory = self::getBaseDirectory() . DIRECTORY_SEPARATOR . $vehicleId;

        if (!is_dir($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
            throw new \RuntimeException('Не удалось создать папку для файлов');
        }

        $storedName = uniqid((string) $vehicleId . '_', true) . '.' . strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
        $destination = $directory . DIRECTORY_SEPARATOR . $storedName;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new \RuntimeException('Не удалось переместить загруженный файл');
        }

        return [
            'stored_name' => $storedName,
            'file_path' => $destination,
        ];
    }

    public static function deleteFile(string $path): void
    {
        if (is_file($path)) {
            @unlink($path);
        }
    }

    private static function getBaseDirectory(): string
    {
        return dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'vehicles';
    }
}
