<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Validation;

final class ContractorValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Название обязательно для заполнения';
        } elseif (mb_strlen($data['name']) > 255) {
            $errors['name'] = 'Название не должно превышать 255 символов';
        }

        if (empty($data['inn'])) {
            $errors['inn'] = 'ИНН обязателен';
        } elseif (!preg_match('/^(?:\d{10}|\d{12})$/', $data['inn'])) {
            $errors['inn'] = 'ИНН должен содержать 10 или 12 цифр';
        }

        if (!empty($data['kpp']) && !preg_match('/^\d{9}$/', $data['kpp'])) {
            $errors['kpp'] = 'КПП должен содержать 9 цифр';
        }

        if (!empty($data['ogrn']) && !preg_match('/^(?:\d{13}|\d{15})$/', $data['ogrn'])) {
            $errors['ogrn'] = 'ОГРН должен содержать 13 или 15 цифр';
        }

        if (!empty($data['okved']) && !preg_match('/^\d{2}(?:\.\d{1,4})*$/', $data['okved'])) {
            $errors['okved'] = 'ОКВЭД должен быть в формате 00.00 или 00.00.0';
        }

        if (empty($data['director'])) {
            $errors['director'] = 'ФИО директора обязательно';
        } elseif (mb_strlen($data['director']) > 255) {
            $errors['director'] = 'ФИО директора не должно превышать 255 символов';
        }

        if (!empty($data['contact1_email']) && !filter_var($data['contact1_email'], FILTER_VALIDATE_EMAIL)) {
            $errors['contact1_email'] = 'Некорректный email';
        }

        if ((empty($data['contact1_name']) && !empty($data['contact1_email'])) || (empty($data['contact1_name']) && !empty($data['contact1_phone']))) {
            $errors['contact1_name'] = 'ФИО контакта обязательно, если указан телефон или email';
        } elseif (!empty($data['contact1_name']) && mb_strlen($data['contact1_name']) > 255) {
            $errors['contact1_name'] = 'ФИО контакта не должно превышать 255 символов';
        }

        if (!empty($data['bank_name']) && mb_strlen($data['bank_name']) > 255) {
            $errors['bank_name'] = 'Название банка не должно превышать 255 символов';
        }

        $bankHasValue =
            !empty($data['bank_name']) ||
            !empty($data['bank_account']) ||
            !empty($data['bank_corr_account']) ||
            !empty($data['bank_bik']);

        if ($bankHasValue) {
            if (empty($data['bank_name'])) {
                $errors['bank_name'] = 'Название банка обязательно';
            }

            if (empty($data['bank_account'])) {
                $errors['bank_account'] = 'Номер счета обязателен';
            } elseif (!preg_match('/^\d{20}$/', $data['bank_account'])) {
                $errors['bank_account'] = 'Номер счета должен содержать 20 цифр';
            }

            if (empty($data['bank_corr_account'])) {
                $errors['bank_corr_account'] = 'Корреспондентский счет обязателен';
            } elseif (!preg_match('/^\d{20}$/', $data['bank_corr_account'])) {
                $errors['bank_corr_account'] = 'Корреспондентский счет должен содержать 20 цифр';
            }

            if (empty($data['bank_bik'])) {
                $errors['bank_bik'] = 'БИК обязателен';
            } elseif (!preg_match('/^\d{9}$/', $data['bank_bik'])) {
                $errors['bank_bik'] = 'БИК должен содержать 9 цифр';
            }
        }

        if (empty($data['status']) || !in_array($data['status'], ['active', 'blocked', 'archive'], true)) {
            $errors['status'] = 'Статус указан неверно';
        }

        return $errors;
    }
}
