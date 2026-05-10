<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Services;

use App\Modules\Contractors\Repositories\ContractorRepository;

final class ContractorService
{
    public function __construct(
        private ContractorRepository $repository = new ContractorRepository(),
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
