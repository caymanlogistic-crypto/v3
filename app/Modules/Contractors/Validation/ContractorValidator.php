<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Validation;

final class ContractorValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Name is required';
        }

        if (empty($data['inn'])) {
            $errors['inn'] = 'INN is required';
        }

        if (
            !empty($data['contact1_email']) &&
            !filter_var($data['contact1_email'], FILTER_VALIDATE_EMAIL)
        ) {
            $errors['contact1_email'] = 'Invalid email';
        }

        if (
            empty($data['status']) ||
            !in_array(
                $data['status'],
                ['active', 'blocked', 'archive'],
                true
            )
        ) {
            $errors['status'] = 'Invalid status';
        }

        return $errors;
    }
}
