<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Repositories;

use App\Core\Database\Database;
use PDO;

final class ContractorContactRepository
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
            FROM contractor_contacts
            WHERE id = :id
              AND deleted_at IS NULL
            LIMIT 1"
        );

        $stmt->execute([
            'id' => $id,
        ]);

        $contact = $stmt->fetch(PDO::FETCH_ASSOC);

        return $contact ?: null;
    }

    public function findByContractorId(int $contractorId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT *
            FROM contractor_contacts
            WHERE contractor_id = :contractor_id
              AND deleted_at IS NULL
            ORDER BY is_primary DESC, id DESC"
        );

        $stmt->execute([
            'contractor_id' => $contractorId,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(int $contractorId, array $data): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO contractor_contacts (
                contractor_id,
                full_name,
                position,
                role,
                phone,
                email,
                is_primary,
                is_payment_recipient,
                is_document_recipient,
                status,
                comment,
                created_at
            ) VALUES (
                :contractor_id,
                :full_name,
                :position,
                :role,
                :phone,
                :email,
                :is_primary,
                :is_payment_recipient,
                :is_document_recipient,
                :status,
                :comment,
                NOW()
            )"
        );

        $stmt->execute([
            'contractor_id' => $contractorId,
            'full_name' => $data['full_name'],
            'position' => $data['position'],
            'role' => $data['role'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'is_primary' => $data['is_primary'],
            'is_payment_recipient' => $data['is_payment_recipient'],
            'is_document_recipient' => $data['is_document_recipient'],
            'status' => $data['status'],
            'comment' => $data['comment'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE contractor_contacts
            SET
                full_name = :full_name,
                position = :position,
                role = :role,
                phone = :phone,
                email = :email,
                is_primary = :is_primary,
                is_payment_recipient = :is_payment_recipient,
                is_document_recipient = :is_document_recipient,
                status = :status,
                comment = :comment,
                updated_at = NOW()
            WHERE id = :id"
        );

        $stmt->execute([
            'id' => $id,
            'full_name' => $data['full_name'],
            'position' => $data['position'],
            'role' => $data['role'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'is_primary' => $data['is_primary'],
            'is_payment_recipient' => $data['is_payment_recipient'],
            'is_document_recipient' => $data['is_document_recipient'],
            'status' => $data['status'],
            'comment' => $data['comment'],
        ]);
    }

    public function softDelete(int $id): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE contractor_contacts
            SET deleted_at = NOW()
            WHERE id = :id"
        );

        $stmt->execute([
            'id' => $id,
        ]);
    }
}
