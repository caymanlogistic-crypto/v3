<?php

declare(strict_types=1);

namespace App\Modules\Contractors\DTO;

final readonly class CreateContractorDTO
{
    public function __construct(
        public string $name,
        public string $inn,
        public ?string $kpp,
        public ?string $ogrn,
        public ?string $legalAddress,
        public ?string $director,
        public ?string $directorPost,
        public ?string $phone,
        public ?string $email,
        public ?string $comments
    ) {
    }
}
