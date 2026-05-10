<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Services;

use App\Modules\Contractors\Repositories\ContractorContactRepository;

final class ContractorContactService
{
    public function __construct(
        private ContractorContactRepository $repository = new ContractorContactRepository(),
    ) {
    }

    public function findById(int $id): ?array
    {
        return $this->repository->findById($id);
    }

    public function findByContractorId(int $contractorId): array
    {
        return $this->repository->findByContractorId($contractorId);
    }

    public function create(int $contractorId, array $data): void
    {
        $this->repository->create($contractorId, $data);
    }

    public function update(int $id, array $data): void
    {
        $this->repository->update($id, $data);
    }

    public function softDelete(int $id): void
    {
        $this->repository->softDelete($id);
    }
}
