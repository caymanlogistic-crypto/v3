<?php

declare(strict_types=1);

namespace App\Modules\Crews\Services;

use App\Modules\Crews\Repositories\CrewRepository;

final class CrewService
{
    public function __construct(
        private CrewRepository $repository = new CrewRepository(),
    ) {
    }

    public function paginate(int $page, int $perPage, string $search = ''): array
    {
        return $this->repository->paginateWithRelations($page, $perPage, $search);
    }

    public function findById(int $id): ?array
    {
        return $this->repository->findByIdWithRelations($id);
    }

    public function create(array $data): int
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): void
    {
        $this->repository->update($id, $data);
    }

    public function softDelete(int $id): void
    {
        $this->repository->softDelete($id);
    }

    public function getContractorOptions(): array
    {
        return $this->repository->getContractorOptions();
    }

    public function getDriverOptions(): array
    {
        return $this->repository->getDriverOptions();
    }

    public function getVehicleOptions(): array
    {
        return $this->repository->getVehicleOptions();
    }

    public function contractorExists(int $id): bool
    {
        return $this->repository->contractorExists($id);
    }

    public function driverExists(int $id): bool
    {
        return $this->repository->driverExists($id);
    }

    public function vehicleExists(int $id): bool
    {
        return $this->repository->vehicleExists($id);
    }

    public function collectSoftWarnings(int $driverId, int $vehicleId, string $status, ?int $excludeId = null): array
    {
        if ($status !== 'active') {
            return [];
        }

        $warnings = [];

        if ($driverId > 0) {
            $driverCrews = $this->repository->getActiveCrewsByDriverId($driverId, $excludeId);
            if (!empty($driverCrews)) {
                $warnings[] = '�������� ��� ������������ � ������ �������� ������.';
            }
        }

        if ($vehicleId > 0) {
            $vehicleCrews = $this->repository->getActiveCrewsByVehicleId($vehicleId, $excludeId);
            if (!empty($vehicleCrews)) {
                $warnings[] = '������ ��� ������������ � ������ �������� ������.';
            }
        }

        return $warnings;
    }
}
