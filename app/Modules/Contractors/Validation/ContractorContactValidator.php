<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Validation;

final class ContractorContactValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (!empty($data['full_name'])) {
            $fullName = trim((string) $data['full_name']);
            $parts = preg_split('/\s+/u', $fullName, -1, PREG_SPLIT_NO_EMPTY);

            if (count($parts) !== 3 || array_filter($parts, static fn ($part) => mb_strlen($part) >= 2) !== $parts) {
                $errors['full_name'] = 'ФИО должно быть в формате: Фамилия Имя Отчество';
            }
        }

        if (
            !empty($data['email']) &&
            !filter_var($data['email'], FILTER_VALIDATE_EMAIL)
        ) {
            $errors['email'] = 'Некорректный email';
        }

        if (
            empty($data['role']) ||
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
            $errors['role'] = 'Роль указана неверно';
        }

        if (
            empty($data['status']) ||
            !in_array(
                $data['status'],
                [
                    'active',
                    'inactive',
                ],
                true
            )
        ) {
            $errors['status'] = 'Статус указан неверно';
        }

        return $errors;
    }
}
