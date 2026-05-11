<?php

declare(strict_types=1);

namespace App\Modules\Drivers\Validation;

final class DriverValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['full_name'])) {
            $errors['full_name'] = 'ФИО водителя обязательно';
        } else {
            $parts = preg_split('/\s+/u', trim((string) $data['full_name']), -1, PREG_SPLIT_NO_EMPTY);
            if (count($parts) !== 3 || array_filter($parts, static fn(string $part): bool => mb_strlen($part) < 2)) {
                $errors['full_name'] = 'ФИО должно быть в формате: Фамилия Имя Отчество';
            }
        }

        if (empty($data['phone'])) {
            $errors['phone'] = 'Телефон обязателен';
        } else {
            $digits = preg_replace('/\D+/', '', (string) $data['phone']);
            if (!preg_match('/^(7|8)\d{10}$/', (string) $digits)) {
                $errors['phone'] = 'Телефон должен содержать 11 цифр и начинаться с 7 или 8';
            }
        }

        if (empty($data['email'])) {
            $errors['email'] = 'Email обязателен';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Некорректный email';
        }

        if (empty($data['passport_number'])) {
            $errors['passport_number'] = 'Номер паспорта обязателен';
        } elseif (!preg_match('/^\d{10}$/', (string) $data['passport_number'])) {
            $errors['passport_number'] = 'Номер паспорта должен содержать 10 цифр';
        }

        if (empty($data['passport_issue_date'])) {
            $errors['passport_issue_date'] = 'Дата выдачи паспорта обязательна';
        } elseif (!$this->isValidIsoDate((string) $data['passport_issue_date'])) {
            $errors['passport_issue_date'] = 'Дата должна быть корректной. Пример: 10.01.2019';
        }

        if (empty($data['passport_issued_by'])) {
            $errors['passport_issued_by'] = 'Кем выдан паспорт — обязательное поле';
        }

        if (empty($data['license_number'])) {
            $errors['license_number'] = 'Номер ВУ обязателен';
        } elseif (!preg_match('/^\d{10}$/', (string) $data['license_number'])) {
            $errors['license_number'] = 'Номер ВУ должен содержать 10 цифр';
        }

        if (empty($data['license_issue_date'])) {
            $errors['license_issue_date'] = 'Дата выдачи ВУ обязательна';
        } elseif (!$this->isValidIsoDate((string) $data['license_issue_date'])) {
            $errors['license_issue_date'] = 'Дата должна быть корректной. Пример: 10.01.2019';
        }

        if (empty($data['snils'])) {
            $errors['snils'] = 'СНИЛС обязателен';
        } elseif (!preg_match('/^\d{11}$/', (string) $data['snils'])) {
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
