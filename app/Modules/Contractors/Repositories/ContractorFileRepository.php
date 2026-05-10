<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Repositories;

use App\Core\Database\Database;
use PDO;

final class ContractorFileRepository
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
            FROM contractor_files
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

    public function findByContractorId(int $contractorId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT *
            FROM contractor_files
            WHERE contractor_id = :contractor_id
              AND deleted_at IS NULL
            ORDER BY id DESC"
        );

        $stmt->execute([
            'contractor_id' => $contractorId,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(int $contractorId, array $data): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO contractor_files (
                contractor_id,
                original_name,
                stored_name,
                file_path,
                mime_type,
                file_extension,
                file_size,
                comment,
                created_at
            ) VALUES (
                :contractor_id,
                :original_name,
                :stored_name,
                :file_path,
                :mime_type,
                :file_extension,
                :file_size,
                :comment,
                NOW()
            )"
        );

        $stmt->execute([
            'contractor_id' => $contractorId,
            'original_name' => $data['original_name'],
            'stored_name' => $data['stored_name'],
            'file_path' => $data['file_path'],
            'mime_type' => $data['mime_type'],
            'file_extension' => $data['file_extension'],
            'file_size' => $data['file_size'],
            'comment' => $data['comment'],
        ]);
    }

    public function softDelete(int $id): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE contractor_files
            SET deleted_at = NOW()
            WHERE id = :id"
        );

        $stmt->execute([
            'id' => $id,
        ]);
    }
}
