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
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);
    }

    public function softDelete(int $id): void
    {
        $this->repository->softDelete($id);
    }
}
