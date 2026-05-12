<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Validation;

final class ContractorValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Название подрядчика обязательно';
        } elseif (mb_strlen((string) $data['name']) > 255) {
            $errors['name'] = 'Название не должно превышать 255 символов';
        }

        if (empty($data['inn'])) {
            $errors['inn'] = 'ИНН обязателен';
        } elseif (!preg_match('/^(?:\d{10}|\d{12})$/', (string) $data['inn'])) {
            $errors['inn'] = 'ИНН должен содержать 10 или 12 цифр';
        }

        if (!empty($data['kpp']) && !preg_match('/^\d{9}$/', (string) $data['kpp'])) {
            $errors['kpp'] = 'КПП должен содержать 9 цифр';
        }

        if (!empty($data['ogrn']) && !preg_match('/^(?:\d{13}|\d{15})$/', (string) $data['ogrn'])) {
            $errors['ogrn'] = 'ОГРН должен содержать 13 или 15 цифр';
        }

        if (!empty($data['okved']) && !preg_match('/^\d{2}(?:\.\d{1,4})*$/', (string) $data['okved'])) {
            $errors['okved'] = 'ОКВЭД может содержать только цифры и точки';
        }

        if (!empty($data['director']) && mb_strlen((string) $data['director']) > 255) {
            $errors['director'] = 'ФИО директора не должно превышать 255 символов';
        }

        if (!empty($data['contact1_name']) && mb_strlen((string) $data['contact1_name']) > 255) {
            $errors['contact1_name'] = 'ФИО контакта не должно превышать 255 символов';
        }

        if (!empty($data['contact1_phone'])) {
            $phoneDigits = preg_replace('/\D+/', '', (string) $data['contact1_phone']);
            if (!preg_match('/^(7|8)\d{10}$/', (string) $phoneDigits)) {
                $errors['contact1_phone'] = 'Телефон должен содержать 11 цифр и начинаться с 7 или 8';
            }
        }

        if (!empty($data['contact1_email']) && !filter_var($data['contact1_email'], FILTER_VALIDATE_EMAIL)) {
            $errors['contact1_email'] = 'Некорректный email';
        }

        if (!empty($data['bank_name']) && mb_strlen((string) $data['bank_name']) > 255) {
            $errors['bank_name'] = 'Название банка не должно превышать 255 символов';
        }

        if (!empty($data['bank_account']) && !preg_match('/^\d{20}$/', (string) $data['bank_account'])) {
            $errors['bank_account'] = 'Номер счета должен содержать 20 цифр';
        }

        if (!empty($data['bank_corr_account']) && !preg_match('/^\d{20}$/', (string) $data['bank_corr_account'])) {
            $errors['bank_corr_account'] = 'Корреспондентский счет должен содержать 20 цифр';
        }

        if (!empty($data['bank_bik']) && !preg_match('/^\d{9}$/', (string) $data['bank_bik'])) {
            $errors['bank_bik'] = 'БИК должен содержать 9 цифр';
        }

        if (empty($data['status']) || !in_array($data['status'], ['active', 'blocked', 'archive'], true)) {
            $errors['status'] = 'Статус указан неверно';
        }

        return $errors;
    }
}
