<?php

declare(strict_types=1);

namespace App\Modules\Vehicles\Repositories;

use App\Core\Database\Database;
use App\Core\Pagination\Paginator;

use PDO;

final class VehicleRepository
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
            INSERT INTO vehicles (
                truck_brand,
                truck_model,
                truck_plate,
                truck_vin,
                truck_load_capacity,
                truck_body_volume,
                trailer_brand,
                trailer_model,
                trailer_plate,
                trailer_vin,
                trailer_load_capacity,
                trailer_body_volume,
                load_capacity,
                body_volume,
                comments,
                status,
                created_at
            ) VALUES (
                :truck_brand,
                :truck_model,
                :truck_plate,
                :truck_vin,
                :truck_load_capacity,
                :truck_body_volume,
                :trailer_brand,
                :trailer_model,
                :trailer_plate,
                :trailer_vin,
                :trailer_load_capacity,
                :trailer_body_volume,
                :load_capacity,
                :body_volume,
                :comments,
                :status,
                NOW()
            )
        ");

        $stmt->execute([
            'truck_brand' => $data['truck_brand'],
            'truck_model' => $data['truck_model'],
            'truck_plate' => $data['truck_plate'],
            'truck_vin' => $data['truck_vin'],
            'truck_load_capacity' => $data['truck_load_capacity'],
            'truck_body_volume' => $data['truck_body_volume'],
            'trailer_brand' => $data['trailer_brand'],
            'trailer_model' => $data['trailer_model'],
            'trailer_plate' => $data['trailer_plate'],
            'trailer_vin' => $data['trailer_vin'],
            'trailer_load_capacity' => $data['trailer_load_capacity'],
            'trailer_body_volume' => $data['trailer_body_volume'],
            'load_capacity' => $data['truck_load_capacity'],
            'body_volume' => $data['truck_body_volume'],
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
            FROM vehicles
            WHERE id = :id
              AND deleted_at IS NULL
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id,
        ]);

        $vehicle = $stmt->fetch(
            PDO::FETCH_ASSOC
        );

        return $vehicle ?: null;
    }

    public function update(
        int $id,
        array $data
    ): void {

        $stmt = $this->pdo->prepare("
            UPDATE vehicles
            SET truck_brand = :truck_brand,
                truck_model = :truck_model,
                truck_plate = :truck_plate,
                truck_vin = :truck_vin,
                truck_load_capacity = :truck_load_capacity,
                truck_body_volume = :truck_body_volume,
                trailer_brand = :trailer_brand,
                trailer_model = :trailer_model,
                trailer_plate = :trailer_plate,
                trailer_vin = :trailer_vin,
                trailer_load_capacity = :trailer_load_capacity,
                trailer_body_volume = :trailer_body_volume,
                load_capacity = :load_capacity,
                body_volume = :body_volume,
                comments = :comments,
                status = :status,
                updated_at = NOW()
            WHERE id = :id
              AND deleted_at IS NULL
        ");

        $stmt->execute([
            'id' => $id,
            'truck_brand' => $data['truck_brand'],
            'truck_model' => $data['truck_model'],
            'truck_plate' => $data['truck_plate'],
            'truck_vin' => $data['truck_vin'],
            'truck_load_capacity' => $data['truck_load_capacity'],
            'truck_body_volume' => $data['truck_body_volume'],
            'trailer_brand' => $data['trailer_brand'],
            'trailer_model' => $data['trailer_model'],
            'trailer_plate' => $data['trailer_plate'],
            'trailer_vin' => $data['trailer_vin'],
            'trailer_load_capacity' => $data['trailer_load_capacity'],
            'trailer_body_volume' => $data['trailer_body_volume'],
            'load_capacity' => $data['truck_load_capacity'],
            'body_volume' => $data['truck_body_volume'],
            'comments' => $data['comments'],
            'status' => $data['status'],
        ]);
    }

    public function softDelete(
        int $id
    ): void {

        $stmt = $this->pdo->prepare("
            UPDATE vehicles
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

        $offset = ($page - 1) * $perPage;

        $whereClause = 'WHERE deleted_at IS NULL';
        $params = [];

        if (!empty($search)) {
            $whereClause .= ' AND (
                truck_plate LIKE :search
                OR trailer_plate LIKE :search
                OR truck_brand LIKE :search
                OR truck_model LIKE :search
                OR truck_vin LIKE :search
                OR trailer_vin LIKE :search
            )';
            $params['search'] = '%' . $search . '%';
        }

        $countStmt = $this->pdo->prepare("
            SELECT COUNT(*) as total
            FROM vehicles
            $whereClause
        ");

        $countStmt->execute($params);
        $total = (int) $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        $paginator = new Paginator(
            $page,
            $perPage,
            $total
        );

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM vehicles
            $whereClause
            ORDER BY id DESC
            LIMIT :limit OFFSET :offset
        ");

        $stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'data' => $data,
            'pagination' => $paginator->toArray(),
        ];
    }

    public function count(
        string $search = ''
    ): int {

        $whereClause = 'WHERE deleted_at IS NULL';
        $params = [];

        if (!empty($search)) {
            $whereClause .= ' AND (
                truck_plate LIKE :search
                OR trailer_plate LIKE :search
                OR truck_brand LIKE :search
                OR truck_model LIKE :search
                OR truck_vin LIKE :search
                OR trailer_vin LIKE :search
            )';
            $params['search'] = '%' . $search . '%';
        }

        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) as total
            FROM vehicles
            $whereClause
        ");

        $stmt->execute($params);

        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
