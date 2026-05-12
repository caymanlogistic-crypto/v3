<?php

declare(strict_types=1);

namespace App\Modules\Drivers\Repositories;

use App\Core\Database\Database;
use App\Core\Pagination\Paginator;

use PDO;

final class DriverRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function create(
        array $data
    ): int {

        $stmt = $this->pdo->prepare("
            INSERT INTO drivers (
                full_name,
                phone,
                email,
                passport_number,
                passport_issue_date,
                passport_issued_by,
                license_number,
                license_issue_date,
                snils,
                comments,
                status,
                created_at
            ) VALUES (
                :full_name,
                :phone,
                :email,
                :passport_number,
                :passport_issue_date,
                :passport_issued_by,
                :license_number,
                :license_issue_date,
                :snils,
                :comments,
                :status,
                NOW()
            )
        ");

        $stmt->execute([
            'full_name' => $data['full_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'passport_number' => $data['passport_number'],
            'passport_issue_date' => $data['passport_issue_date'],
            'passport_issued_by' => $data['passport_issued_by'],
            'license_number' => $data['license_number'],
            'license_issue_date' => $data['license_issue_date'],
            'snils' => $data['snils'],
            'comments' => $data['comments'],
            'status' => $data['status'],
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function findById(
        int $id
    ): ?array {

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM drivers
            WHERE id = :id
              AND deleted_at IS NULL
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id,
        ]);

        $driver = $stmt->fetch(
            PDO::FETCH_ASSOC
        );

        return $driver ?: null;
    }

    public function update(
        int $id,
        array $data
    ): void {

        $stmt = $this->pdo->prepare("
            UPDATE drivers
            SET
                full_name = :full_name,
                phone = :phone,
                email = :email,
                passport_number = :passport_number,
                passport_issue_date = :passport_issue_date,
                passport_issued_by = :passport_issued_by,
                license_number = :license_number,
                license_issue_date = :license_issue_date,
                snils = :snils,
                comments = :comments,
                status = :status,
                updated_at = NOW()
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id,
            'full_name' => $data['full_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'passport_number' => $data['passport_number'],
            'passport_issue_date' => $data['passport_issue_date'],
            'passport_issued_by' => $data['passport_issued_by'],
            'license_number' => $data['license_number'],
            'license_issue_date' => $data['license_issue_date'],
            'snils' => $data['snils'],
            'comments' => $data['comments'],
            'status' => $data['status'],
        ]);
    }

    public function softDelete(
        int $id
    ): void {

        $stmt = $this->pdo->prepare("
            UPDATE drivers
            SET deleted_at = NOW()
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id,
        ]);
    }

    public function paginate(
        int $page,
        int $perPage,
        ?string $search = null
    ): array {

        $where = "deleted_at IS NULL";

        $params = [];

        if ($search !== null && $search !== '') {

            $where .= "
                AND (
                    full_name LIKE :search
                    OR phone LIKE :search
                    OR license_number LIKE :search
                )
            ";

            $params['search'] =
                '%' . $search . '%';
        }

        $countStmt = $this->pdo->prepare("
            SELECT COUNT(*) as total
            FROM drivers
            WHERE {$where}
        ");

        $countStmt->execute($params);

        $total = (int)
            $countStmt
                ->fetch(PDO::FETCH_ASSOC)['total'];

        $paginator = new Paginator(
            $page,
            $perPage,
            $total
        );

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM drivers
            WHERE {$where}
            ORDER BY full_name ASC
            LIMIT :limit
            OFFSET :offset
        ");

        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $paginator->offset(), PDO::PARAM_INT);

        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmt->execute();

        $drivers = $stmt->fetchAll(
            PDO::FETCH_ASSOC
        );

        return [
            'data' => $drivers,
            'pagination' => $paginator->toArray(),
        ];
    }

    public function count(
        ?string $search = null
    ): int {

        $where = "deleted_at IS NULL";

        $params = [];

        if ($search !== null && $search !== '') {

            $where .= "
                AND (
                    full_name LIKE :search
                    OR phone LIKE :search
                    OR license_number LIKE :search
                )
            ";

            $params['search'] =
                '%' . $search . '%';
        }

        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) as total
            FROM drivers
            WHERE {$where}
        ");

        $stmt->execute($params);

        return (int)
            $stmt
                ->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
