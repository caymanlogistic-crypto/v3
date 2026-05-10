<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Validation;

final class ContractorContactValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (
            !empty($data['email']) &&
            !filter_var($data['email'], FILTER_VALIDATE_EMAIL)
        ) {
            $errors['email'] = 'Invalid email';
        }

        if (
            !in_array(
                $data['role'],
                [
                    'director',
                    'manager',
                    'accounting',
                    'dispatcher',
                    'owner',
                    'other',
                ],
                true
            )
        ) {
            $errors['role'] = 'Invalid role';
        }

        if (
            !in_array(
                $data['status'],
                [
                    'active',
                    'inactive',
                ],
                true
            )
        ) {
            $errors['status'] = 'Invalid status';
        }

        return $errors;
    }
}
