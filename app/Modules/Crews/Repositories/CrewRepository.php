<?php

declare(strict_types=1);

namespace App\Modules\Crews\Repositories;

use App\Core\Database\Database;
use App\Core\Pagination\Paginator;
use PDO;

final class CrewRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function paginateWithRelations(int $page, int $perPage, string $search = ''): array
    {
        $where = 'cc.deleted_at IS NULL';
        $params = [];

        if ($search !== '') {
            $where .= ' AND (
                c.name LIKE :search
                OR c.inn LIKE :search
                OR d.full_name LIKE :search
                OR d.phone LIKE :search
                OR v.truck_plate LIKE :search
                OR v.truck_brand LIKE :search
            )';
            $params['search'] = '%' . $search . '%';
        }

        $countStmt = $this->pdo->prepare(
            "SELECT COUNT(*) AS total
             FROM contractor_crews cc
             INNER JOIN contractors c ON c.id = cc.contractor_id
             INNER JOIN drivers d ON d.id = cc.driver_id
             INNER JOIN vehicles v ON v.id = cc.vehicle_id
             WHERE {$where}"
        );
        $countStmt->execute($params);
        $total = (int) ($countStmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0);

        $paginator = new Paginator($page, $perPage, $total);

        $stmt = $this->pdo->prepare(
            "SELECT
                cc.*,
                c.name AS contractor_name,
                c.inn AS contractor_inn,
                d.full_name AS driver_name,
                d.phone AS driver_phone,
                v.truck_plate AS vehicle_plate,
                v.truck_brand AS vehicle_brand,
                (
                    SELECT COUNT(*)
                    FROM contractor_crews ccd
                    WHERE ccd.deleted_at IS NULL
                      AND ccd.status = 'active'
                      AND ccd.driver_id = cc.driver_id
                      AND ccd.id <> cc.id
                ) AS duplicate_driver_active,
                (
                    SELECT COUNT(*)
                    FROM contractor_crews ccv
                    WHERE ccv.deleted_at IS NULL
                      AND ccv.status = 'active'
                      AND ccv.vehicle_id = cc.vehicle_id
                      AND ccv.id <> cc.id
                ) AS duplicate_vehicle_active
             FROM contractor_crews cc
             INNER JOIN contractors c ON c.id = cc.contractor_id
             INNER JOIN drivers d ON d.id = cc.driver_id
             INNER JOIN vehicles v ON v.id = cc.vehicle_id
             WHERE {$where}
             ORDER BY cc.id DESC
             LIMIT :limit OFFSET :offset"
        );

        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $paginator->offset(), PDO::PARAM_INT);

        $stmt->execute();

        return [
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'pagination' => $paginator->toArray(),
        ];
    }

    public function findByIdWithRelations(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT
                cc.*,
                c.name AS contractor_name,
                c.inn AS contractor_inn,
                d.full_name AS driver_name,
                d.phone AS driver_phone,
                v.truck_plate AS vehicle_plate,
                v.truck_brand AS vehicle_brand
             FROM contractor_crews cc
             INNER JOIN contractors c ON c.id = cc.contractor_id
             INNER JOIN drivers d ON d.id = cc.driver_id
             INNER JOIN vehicles v ON v.id = cc.vehicle_id
             WHERE cc.id = :id
               AND cc.deleted_at IS NULL
             LIMIT 1"
        );

        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO contractor_crews (
                contractor_id,
                driver_id,
                vehicle_id,
                status,
                comment,
                created_at
            ) VALUES (
                :contractor_id,
                :driver_id,
                :vehicle_id,
                :status,
                :comment,
                NOW()
            )"
        );

        $stmt->execute([
            'contractor_id' => $data['contractor_id'],
            'driver_id' => $data['driver_id'],
            'vehicle_id' => $data['vehicle_id'],
            'status' => $data['status'],
            'comment' => $data['comment'],
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE contractor_crews
             SET contractor_id = :contractor_id,
                 driver_id = :driver_id,
                 vehicle_id = :vehicle_id,
                 status = :status,
                 comment = :comment,
                 updated_at = NOW()
             WHERE id = :id
               AND deleted_at IS NULL"
        );

        $stmt->execute([
            'id' => $id,
            'contractor_id' => $data['contractor_id'],
            'driver_id' => $data['driver_id'],
            'vehicle_id' => $data['vehicle_id'],
            'status' => $data['status'],
            'comment' => $data['comment'],
        ]);
    }

    public function softDelete(int $id): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE contractor_crews
             SET deleted_at = NOW(),
                 updated_at = NOW()
             WHERE id = :id
               AND deleted_at IS NULL"
        );

        $stmt->execute(['id' => $id]);
    }

    public function getActiveCrewsByDriverId(int $driverId, ?int $excludeId = null): array
    {
        $sql = "SELECT id, contractor_id, driver_id, vehicle_id, status
                FROM contractor_crews
                WHERE deleted_at IS NULL
                  AND status = 'active'
                  AND driver_id = :driver_id";

        $params = ['driver_id' => $driverId];

        if ($excludeId !== null) {
            $sql .= ' AND id <> :exclude_id';
            $params['exclude_id'] = $excludeId;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActiveCrewsByVehicleId(int $vehicleId, ?int $excludeId = null): array
    {
        $sql = "SELECT id, contractor_id, driver_id, vehicle_id, status
                FROM contractor_crews
                WHERE deleted_at IS NULL
                  AND status = 'active'
                  AND vehicle_id = :vehicle_id";

        $params = ['vehicle_id' => $vehicleId];

        if ($excludeId !== null) {
            $sql .= ' AND id <> :exclude_id';
            $params['exclude_id'] = $excludeId;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getContractorOptions(): array
    {
        $stmt = $this->pdo->query(
            "SELECT id, name, inn
             FROM contractors
             WHERE deleted_at IS NULL
             ORDER BY name ASC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDriverOptions(): array
    {
        $stmt = $this->pdo->query(
            "SELECT id, full_name, phone
             FROM drivers
             WHERE deleted_at IS NULL
             ORDER BY full_name ASC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVehicleOptions(): array
    {
        $stmt = $this->pdo->query(
            "SELECT id, truck_plate, truck_brand
             FROM vehicles
             WHERE deleted_at IS NULL
             ORDER BY truck_plate ASC, id DESC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contractorExists(int $id): bool
    {
        return $this->existsById('contractors', $id);
    }

    public function driverExists(int $id): bool
    {
        return $this->existsById('drivers', $id);
    }

    public function vehicleExists(int $id): bool
    {
        return $this->existsById('vehicles', $id);
    }

    private function existsById(string $table, int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "SELECT COUNT(*) AS total
             FROM {$table}
             WHERE id = :id
               AND deleted_at IS NULL"
        );

        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) ($row['total'] ?? 0) > 0;
    }
}
