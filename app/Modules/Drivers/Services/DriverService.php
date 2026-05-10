<?php

declare(strict_types=1);

namespace App\Modules\Drivers\Services;

use App\Modules\Drivers\Repositories\DriverRepository;

final class DriverService
{
    public function __construct(
        private DriverRepository $repository = new DriverRepository(),
    ) {
    }

    public function update(int $id, array $data): void
    {
        $this->repository->update($id, $data);
    }

    public function softDelete(int $id): void
    {
        $this->repository->softDelete($id);
    }

    public function create(array $data): int
    {
        return $this->repository->create($data);
    }

    public function findById(int $id): ?array
    {
        return $this->repository->findById($id);
    }

    public function paginate(
        int $page,
        int $perPage,
        string $search = ''
    ): array {
        return $this->repository->paginate(
            $page,
            $perPage,
            $search
        );
    }
}
