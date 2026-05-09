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
        $this->repository->update($id, [
            'name' => $data['name'],
            'inn' => $data['inn'],
            'contact1_phone' => $data['contact1_phone'],
            'contact1_email' => $data['contact1_email'],
            'legal_address' => $data['legal_address'],
            'status' => $data['status'],
        ]);
    }

    public function softDelete(int $id): void
    {
        $this->repository->softDelete($id);
    }

    public function create(array $data): void
    {
        $this->repository->create($data);
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
