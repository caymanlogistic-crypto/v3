<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Validators;

use App\Core\Validation\ValidationException;

final class ContractorValidator
{
    public function validateCreate(array $data): void
    {
        $errors = [];

        if (empty(trim($data['name'] ?? ''))) {
            $errors['name'] = 'Name is required';
        }

        if (empty(trim($data['inn'] ?? ''))) {
            $errors['inn'] = 'INN is required';
        }

        $inn = preg_replace('/\D/', '', $data['inn'] ?? '');

        if (
            $inn !== ''
            && !in_array(strlen($inn), [10, 12], true)
        ) {
            $errors['inn'] = 'INN must contain 10 or 12 digits';
        }

        if (!empty($errors)) {
            throw new ValidationException($errors);
        }
    }
}
