<?php

declare(strict_types=1);

namespace App\Modules\Vehicles\Services;

use App\Modules\Vehicles\Repositories\VehicleFileRepository;

final class VehicleFileService
{
    public function __construct(
        private VehicleFileRepository $repository = new VehicleFileRepository(),
    ) {
    }

    public function findById(int $id): ?array
    {
        return $this->repository->findById($id);
    }

    public function findByVehicleId(int $vehicleId): array
    {
        return $this->repository->findByVehicleId($vehicleId);
    }

    public function create(int $vehicleId, array $data): void
    {
        $this->repository->create($vehicleId, $data);
    }

    public function softDelete(int $id): void
    {
        $this->repository->softDelete($id);
    }
}