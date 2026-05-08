<?php

declare(strict_types=1);

namespace App\Core\Validation;

use Exception;

final class ValidationException extends Exception
{
    public function __construct(
        private readonly array $errors
    ) {
        parent::__construct('Validation failed');
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
