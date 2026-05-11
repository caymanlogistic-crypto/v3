<?php

declare(strict_types=1);

namespace App\Modules\Drivers\Validation;

final class DriverValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['full_name'])) {
            $errors['full_name'] = 'ФИО обязательно для заполнения';
        } else {
            $parts = preg_split('/\s+/u', trim($data['full_name']), -1, PREG_SPLIT_NO_EMPTY);

            if (count($parts) !== 3) {
                $errors['full_name'] = 'ФИО должно быть в формате: Фамилия Имя Отчество';
            } else {
                foreach ($parts as $part) {
                    if (mb_strlen($part) < 2) {
                        $errors['full_name'] = 'ФИО должно быть в формате: Фамилия Имя Отчество';
                        break;
                    }
                }
            }
        }

        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Некорректный email';
        }

        if (!empty($data['passport_number']) && !preg_match('/^\d{10}$/', $data['passport_number'])) {
            $errors['passport_number'] = 'Номер паспорта должен содержать 10 цифр';
        }

        if (!empty($data['passport_issue_date']) && !$this->isValidIsoDate((string) $data['passport_issue_date'])) {
            $errors['passport_issue_date'] = 'Дата должна быть корректной. Пример: 10.01.2019';
        }

        if (empty($data['license_number'])) {
            $errors['license_number'] = 'Номер ВУ обязателен';
        } elseif (!preg_match('/^\d{10}$/', $data['license_number'])) {
            $errors['license_number'] = 'Номер ВУ должен содержать 10 цифр';
        }

        if (!empty($data['license_issue_date']) && !$this->isValidIsoDate((string) $data['license_issue_date'])) {
            $errors['license_issue_date'] = 'Дата должна быть корректной. Пример: 10.01.2019';
        }

        if (!empty($data['snils']) && !preg_match('/^\d{11}$/', $data['snils'])) {
            $errors['snils'] = 'СНИЛС должен содержать 11 цифр';
        }

        if (empty($data['status']) || !in_array($data['status'], ['active', 'blocked', 'archive'], true)) {
            $errors['status'] = 'Статус указан неверно';
        }

        return $errors;
    }

    private function isValidIsoDate(string $value): bool
    {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value) !== 1) {
            return false;
        }

        [$year, $month, $day] = array_map('intval', explode('-', $value));

        return checkdate($month, $day, $year);
    }
}