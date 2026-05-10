<?php

declare(strict_types=1);

namespace App\Modules\Drivers\Services;

use App\Modules\Drivers\Repositories\DriverFileRepository;

final class DriverFileService
{
    public function __construct(
        private DriverFileRepository $repository = new DriverFileRepository(),
    ) {
    }

    public function findById(int $id): ?array
    {
        return $this->repository->findById($id);
    }

    public function findByDriverId(int $driverId): array
    {
        return $this->repository->findByDriverId($driverId);
    }

    public function create(int $driverId, array $data): void
    {
        $this->repository->create($driverId, $data);
    }

    public function softDelete(int $id): void
    {
        $this->repository->softDelete($id);
    }
}
