<?php

declare(strict_types=1);

namespace App\Modules\Vehicles\Support;

final class VehicleFileStorage
{
    public static function getBaseDirectory(): string
    {
        return dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'vehicles';
    }

    public static function getVehicleDirectory(int $vehicleId): string
    {
        return self::getBaseDirectory()
            . DIRECTORY_SEPARATOR
            . $vehicleId
            . DIRECTORY_SEPARATOR
            . 'files';
    }

    public static function ensureDirectory(int $vehicleId): bool
    {
        $directory = self::getVehicleDirectory($vehicleId);

        if (is_dir($directory)) {
            return true;
        }

        return mkdir($directory, 0755, true);
    }

    public static function moveUploadedFile(array $file, int $vehicleId): array
    {
        if (!self::ensureDirectory($vehicleId)) {
            throw new \RuntimeException('Unable to create file directory');
        }

        $storedName = uniqid((string) $vehicleId . '_', true) . '.' . strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
        $destination = self::getVehicleDirectory($vehicleId) . DIRECTORY_SEPARATOR . $storedName;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new \RuntimeException('Failed to move uploaded file');
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
}
