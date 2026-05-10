<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Support;

final class ContractorFileStorage
{
    public static function getBaseDirectory(): string
    {
        return dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'contractors';
    }

    public static function getContractorDirectory(int $contractorId): string
    {
        return self::getBaseDirectory()
            . DIRECTORY_SEPARATOR
            . $contractorId
            . DIRECTORY_SEPARATOR
            . 'files';
    }

    public static function ensureDirectory(int $contractorId): bool
    {
        $directory = self::getContractorDirectory($contractorId);

        if (is_dir($directory)) {
            return true;
        }

        return mkdir($directory, 0755, true);
    }

    public static function sanitizeFilename(string $filename): string
    {
        $filename = basename($filename);
        $filename = preg_replace('/[^a-zA-Z0-9_\-.]/u', '_', $filename);
        $filename = preg_replace('/_+/', '_', $filename);
        $filename = trim($filename, '_');

        if ($filename === '') {
            return 'file';
        }

        return $filename;
    }

    public static function moveUploadedFile(array $file, int $contractorId): array
    {
        if (!self::ensureDirectory($contractorId)) {
            throw new \RuntimeException('Unable to create file directory');
        }

        $originalName = $file['name'] ?? 'file';
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
        $safeName = self::sanitizeFilename($nameWithoutExtension);
        $storedName = uniqid() . '_' . $safeName;

        if ($extension !== '') {
            $storedName .= '.' . $extension;
        }

        $destination = self::getContractorDirectory($contractorId)
            . DIRECTORY_SEPARATOR
            . $storedName;

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
