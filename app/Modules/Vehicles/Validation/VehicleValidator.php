<?php

declare(strict_types=1);

namespace App\Modules\Vehicles\Validation;

final class VehicleValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['truck_plate'])) {
            $errors['truck_plate'] = 'Госномер тягача обязателен';
        } elseif (mb_strlen((string) $data['truck_plate']) < 6 || mb_strlen((string) $data['truck_plate']) > 20) {
            $errors['truck_plate'] = 'Госномер тягача должен содержать от 6 до 20 символов';
        }

        if (empty($data['truck_brand'])) {
            $errors['truck_brand'] = 'Марка тягача обязательна';
        } elseif (mb_strlen((string) $data['truck_brand']) > 100) {
            $errors['truck_brand'] = 'Марка тягача не должна превышать 100 символов';
        }

        if (!empty($data['truck_model']) && mb_strlen((string) $data['truck_model']) > 100) {
            $errors['truck_model'] = 'Модель тягача не должна превышать 100 символов';
        }

        if (empty($data['truck_vin'])) {
            $errors['truck_vin'] = 'VIN тягача обязателен';
        } elseif (!$this->isValidVin((string) $data['truck_vin'])) {
            $errors['truck_vin'] = $this->buildVinError((string) $data['truck_vin']);
        }

        $this->validateRequiredDecimalRange(
            $data,
            $errors,
            'truck_load_capacity',
            'Грузоподъёмность тягача обязательна',
            'Грузоподъёмность тягача должна быть числом',
            'Грузоподъёмность тягача не должна превышать 60',
            60
        );

        $this->validateRequiredDecimalRange(
            $data,
            $errors,
            'truck_body_volume',
            'Объём кузова тягача обязателен',
            'Объём кузова тягача должен быть числом',
            'Объём кузова тягача не должен превышать 150',
            150
        );

        $trailerActive = $this->isTrailerActive($data);

        if ($trailerActive) {
            if (empty($data['trailer_plate'])) {
                $errors['trailer_plate'] = 'Если заполнен полуприцеп, укажите его госномер';
            } elseif (mb_strlen((string) $data['trailer_plate']) < 6 || mb_strlen((string) $data['trailer_plate']) > 20) {
                $errors['trailer_plate'] = 'Госномер полуприцепа должен содержать от 6 до 20 символов';
            }

            if (empty($data['trailer_brand'])) {
                $errors['trailer_brand'] = 'Если заполнен полуприцеп, укажите его марку';
            } elseif (mb_strlen((string) $data['trailer_brand']) > 100) {
                $errors['trailer_brand'] = 'Марка полуприцепа не должна превышать 100 символов';
            }

            if (empty($data['trailer_vin'])) {
                $errors['trailer_vin'] = 'Если заполнен полуприцеп, укажите его VIN';
            } elseif (!$this->isValidVin((string) $data['trailer_vin'])) {
                $errors['trailer_vin'] = $this->buildVinError((string) $data['trailer_vin']);
            }

            $this->validateRequiredDecimalRange(
                $data,
                $errors,
                'trailer_load_capacity',
                'Если заполнен полуприцеп, укажите его грузоподъёмность',
                'Грузоподъёмность полуприцепа должна быть числом',
                'Грузоподъёмность полуприцепа не должна превышать 60',
                60
            );

            $this->validateRequiredDecimalRange(
                $data,
                $errors,
                'trailer_body_volume',
                'Если заполнен полуприцеп, укажите его объём кузова',
                'Объём кузова полуприцепа должен быть числом',
                'Объём кузова полуприцепа не должен превышать 150',
                150
            );
        } else {
            if (!empty($data['trailer_brand']) && mb_strlen((string) $data['trailer_brand']) > 100) {
                $errors['trailer_brand'] = 'Марка полуприцепа не должна превышать 100 символов';
            }

            if (!empty($data['trailer_model']) && mb_strlen((string) $data['trailer_model']) > 100) {
                $errors['trailer_model'] = 'Модель полуприцепа не должна превышать 100 символов';
            }

            if (!empty($data['trailer_plate']) && (mb_strlen((string) $data['trailer_plate']) < 6 || mb_strlen((string) $data['trailer_plate']) > 20)) {
                $errors['trailer_plate'] = 'Госномер полуприцепа должен содержать от 6 до 20 символов';
            }

            if (!empty($data['trailer_vin']) && !$this->isValidVin((string) $data['trailer_vin'])) {
                $errors['trailer_vin'] = $this->buildVinError((string) $data['trailer_vin']);
            }

            $this->validateOptionalDecimalRange($data, $errors, 'trailer_load_capacity', 'Грузоподъёмность полуприцепа должна быть числом', 'Грузоподъёмность полуприцепа не должна превышать 60', 60);
            $this->validateOptionalDecimalRange($data, $errors, 'trailer_body_volume', 'Объём кузова полуприцепа должен быть числом', 'Объём кузова полуприцепа не должен превышать 150', 150);
        }

        if (empty($data['status']) || !in_array($data['status'], ['active', 'blocked', 'archive'], true)) {
            $errors['status'] = 'Некорректный статус';
        }

        return $errors;
    }

    private function isTrailerActive(array $data): bool
    {
        $fields = [
            'trailer_plate',
            'trailer_brand',
            'trailer_model',
            'trailer_vin',
            'trailer_load_capacity',
            'trailer_body_volume',
        ];

        foreach ($fields as $field) {
            if (trim((string) ($data[$field] ?? '')) !== '') {
                return true;
            }
        }

        return false;
    }

    private function validateRequiredDecimalRange(array $data, array &$errors, string $field, string $requiredMessage, string $numericMessage, string $maxMessage, float $max): void
    {
        $value = trim((string) ($data[$field] ?? ''));
        if ($value === '') {
            $errors[$field] = $requiredMessage;
            return;
        }

        $normalized = str_replace([',', ' '], ['.', ''], $value);
        if (!is_numeric($normalized) || (float) $normalized < 0) {
            $errors[$field] = $numericMessage;
            return;
        }

        if ((float) $normalized > $max) {
            $errors[$field] = $maxMessage;
        }
    }

    private function validateOptionalDecimalRange(array $data, array &$errors, string $field, string $numericMessage, string $maxMessage, float $max): void
    {
        $value = trim((string) ($data[$field] ?? ''));
        if ($value === '') {
            return;
        }

        $normalized = str_replace([',', ' '], ['.', ''], $value);
        if (!is_numeric($normalized) || (float) $normalized < 0) {
            $errors[$field] = $numericMessage;
            return;
        }

        if ((float) $normalized > $max) {
            $errors[$field] = $maxMessage;
        }
    }

    private function isValidVin(string $value): bool
    {
        $vin = mb_strtoupper(trim($value), 'UTF-8');

        if (mb_strlen($vin, 'UTF-8') !== 17) {
            return false;
        }

        return preg_match('/^[A-HJ-NPR-Z0-9]{17}$/', $vin) === 1;
    }

    private function buildVinError(string $value): string
    {
        $vin = mb_strtoupper(trim($value), 'UTF-8');

        if (mb_strlen($vin, 'UTF-8') !== 17) {
            return 'VIN должен содержать 17 символов';
        }

        return 'VIN может содержать только латинские буквы и цифры (без I, O, Q)';
    }
}
