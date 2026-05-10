<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Services;

use App\Modules\Contractors\Repositories\ContractorFileRepository;

final class ContractorFileService
{
    public function __construct(
        private ContractorFileRepository $repository = new ContractorFileRepository(),
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

    public function softDelete(int $id): void
    {
        $this->repository->softDelete($id);
    }
}
