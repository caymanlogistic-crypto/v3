<?php

declare(strict_types=1);

namespace App\Modules\Drivers\Repositories;

use App\Core\Database\Database;
use PDO;

final class DriverFileRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT *
            FROM driver_files
            WHERE id = :id
              AND deleted_at IS NULL
            LIMIT 1"
        );

        $stmt->execute([
            'id' => $id,
        ]);

        $file = $stmt->fetch(PDO::FETCH_ASSOC);

        return $file ?: null;
    }

    public function findByDriverId(int $driverId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT *
            FROM driver_files
            WHERE driver_id = :driver_id
              AND deleted_at IS NULL
            ORDER BY id DESC"
        );

        $stmt->execute([
            'driver_id' => $driverId,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(int $driverId, array $data): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO driver_files (
                driver_id,
                original_name,
                stored_name,
                file_path,
                mime_type,
                file_extension,
                file_size,
                file_type,
                uploaded_by,
                comment,
                created_at
            ) VALUES (
                :driver_id,
                :original_name,
                :stored_name,
                :file_path,
                :mime_type,
                :file_extension,
                :file_size,
                :file_type,
                :uploaded_by,
                :comment,
                NOW()
            )"
        );

        $stmt->execute([
            'driver_id' => $driverId,
            'original_name' => $data['original_name'],
            'stored_name' => $data['stored_name'],
            'file_path' => $data['file_path'],
            'mime_type' => $data['mime_type'],
            'file_extension' => $data['file_extension'],
            'file_size' => $data['file_size'],
            'file_type' => $data['file_type'],
            'uploaded_by' => $data['uploaded_by'],
            'comment' => $data['comment'],
        ]);
    }

    public function softDelete(int $id): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE driver_files
            SET deleted_at = NOW()
            WHERE id = :id"
        );

        $stmt->execute([
            'id' => $id,
        ]);
    }
}
