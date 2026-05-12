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
    ): int {

        $stmt = $this->pdo->prepare("
            INSERT INTO contractors (
                name,
                inn,
                kpp,
                ogrn,
                okved,
                legal_address,
                actual_address,
                director,
                director_post,
                contact1_name,
                contact1_phone,
                contact1_email,
                bank_name,
                bank_account,
                bank_corr_account,
                bank_bik,
                comments,
                status,
                created_at
            ) VALUES (
                :name,
                :inn,
                :kpp,
                :ogrn,
                :okved,
                :legal_address,
                :actual_address,
                :director,
                :director_post,
                :contact1_name,
                :contact1_phone,
                :contact1_email,
                :bank_name,
                :bank_account,
                :bank_corr_account,
                :bank_bik,
                :comments,
                :status,
                NOW()
            )
        ");

        $stmt->execute([
            'name' => $data['name'],
            'inn' => $data['inn'],
            'kpp' => $data['kpp'],
            'ogrn' => $data['ogrn'],
            'okved' => $data['okved'],
            'legal_address' => $data['legal_address'],
            'actual_address' => $data['actual_address'],
            'director' => $data['director'],
            'director_post' => $data['director_post'],
            'contact1_name' => $data['contact1_name'],
            'contact1_phone' => $data['contact1_phone'],
            'contact1_email' => $data['contact1_email'],
            'bank_name' => $data['bank_name'],
            'bank_account' => $data['bank_account'],
            'bank_corr_account' => $data['bank_corr_account'],
            'bank_bik' => $data['bank_bik'],
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
                kpp = :kpp,
                ogrn = :ogrn,
                okved = :okved,
                legal_address = :legal_address,
                actual_address = :actual_address,
                director = :director,
                director_post = :director_post,
                contact1_name = :contact1_name,
                contact1_phone = :contact1_phone,
                contact1_email = :contact1_email,
                bank_name = :bank_name,
                bank_account = :bank_account,
                bank_corr_account = :bank_corr_account,
                bank_bik = :bank_bik,
                comments = :comments,
                status = :status,
                updated_at = NOW()
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'inn' => $data['inn'],
            'kpp' => $data['kpp'],
            'ogrn' => $data['ogrn'],
            'okved' => $data['okved'],
            'legal_address' => $data['legal_address'],
            'actual_address' => $data['actual_address'],
            'director' => $data['director'],
            'director_post' => $data['director_post'],
            'contact1_name' => $data['contact1_name'],
            'contact1_phone' => $data['contact1_phone'],
            'contact1_email' => $data['contact1_email'],
            'bank_name' => $data['bank_name'],
            'bank_account' => $data['bank_account'],
            'bank_corr_account' => $data['bank_corr_account'],
            'bank_bik' => $data['bank_bik'],
            'comments' => $data['comments'],
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
