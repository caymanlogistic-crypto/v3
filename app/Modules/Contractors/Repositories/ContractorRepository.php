<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Repositories;

use App\Core\Database\Database;
use App\Core\Pagination\Paginator;

use PDO;

final class ContractorRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function create(
        array $data
    ): void {

        $stmt = $this->pdo->prepare("
            INSERT INTO contractors (
                name,
                inn,
                contact1_phone,
                contact1_email,
                legal_address,
                status,
                created_at
            ) VALUES (
                :name,
                :inn,
                :contact1_phone,
                :contact1_email,
                :legal_address,
                :status,
                NOW()
            )
        ");

        $stmt->execute([
            'name' => $data['name'],
            'inn' => $data['inn'],
            'contact1_phone' => $data['contact1_phone'],
            'contact1_email' => $data['contact1_email'],
            'legal_address' => $data['legal_address'],
            'status' => $data['status'],
        ]);
    }

    public function findById(
        int $id
    ): ?array {

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM contractors
            WHERE id = :id
              AND deleted_at IS NULL
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id,
        ]);

        $contractor = $stmt->fetch(
            PDO::FETCH_ASSOC
        );

        return $contractor ?: null;
    }

    public function update(
        int $id,
        array $data
    ): void {

        $stmt = $this->pdo->prepare("
            UPDATE contractors
            SET
                name = :name,
                inn = :inn,
                contact1_phone = :contact1_phone,
                contact1_email = :contact1_email,
                legal_address = :legal_address,
                status = :status,
                updated_at = NOW()
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'inn' => $data['inn'],
            'contact1_phone' => $data['contact1_phone'],
            'contact1_email' => $data['contact1_email'],
            'legal_address' => $data['legal_address'],
            'status' => $data['status'],
        ]);
    }

    public function softDelete(
        int $id
    ): void {

        $stmt = $this->pdo->prepare("
            UPDATE contractors
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
        string $search = ''
    ): array {

        $where = "deleted_at IS NULL";

        $params = [];

        if ($search !== '') {

            $where .= "
                AND (
                    name LIKE :search
                    OR inn LIKE :search
                    OR contact1_phone LIKE :search
                )
            ";

            $params['search'] =
                '%' . $search . '%';
        }

        $countStmt = $this->pdo->prepare("
            SELECT COUNT(*) as total
            FROM contractors
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
            FROM contractors
            WHERE {$where}
            ORDER BY id DESC
            LIMIT :limit OFFSET :offset
        ");

        foreach (
            $params as $key => $value
        ) {

            $stmt->bindValue(
                ':' . $key,
                $value
            );
        }

        $stmt->bindValue(
            ':limit',
            $perPage,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':offset',
            $paginator->offset(),
            PDO::PARAM_INT
        );

        $stmt->execute();

        return [
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'pagination' => $paginator->toArray(),
        ];
    }
}
