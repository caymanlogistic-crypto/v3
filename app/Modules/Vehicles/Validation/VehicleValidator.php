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
        } elseif (mb_strlen($data['truck_plate']) < 6 || mb_strlen($data['truck_plate']) > 20) {
            $errors['truck_plate'] = 'Госномер тягача должен содержать от 6 до 20 символов';
        }

        if (!empty($data['truck_brand']) && mb_strlen($data['truck_brand']) > 100) {
            $errors['truck_brand'] = 'Марка тягача не должна превышать 100 символов';
        }

        if (!empty($data['truck_model']) && mb_strlen($data['truck_model']) > 100) {
            $errors['truck_model'] = 'Модель тягача не должна превышать 100 символов';
        }

        if (!empty($data['truck_vin']) && mb_strlen($data['truck_vin']) > 50) {
            $errors['truck_vin'] = 'VIN тягача не должен превышать 50 символов';
        }

        if (!empty($data['trailer_brand']) && mb_strlen($data['trailer_brand']) > 100) {
            $errors['trailer_brand'] = 'Марка прицепа не должна превышать 100 символов';
        }

        if (!empty($data['trailer_model']) && mb_strlen($data['trailer_model']) > 100) {
            $errors['trailer_model'] = 'Модель прицепа не должна превышать 100 символов';
        }

        if (!empty($data['trailer_plate']) && (mb_strlen($data['trailer_plate']) < 6 || mb_strlen($data['trailer_plate']) > 20)) {
            $errors['trailer_plate'] = 'Госномер прицепа должен содержать от 6 до 20 символов';
        }

        if (!empty($data['trailer_vin']) && mb_strlen($data['trailer_vin']) > 50) {
            $errors['trailer_vin'] = 'VIN прицепа не должен превышать 50 символов';
        }

        $this->validateDecimalRange($data, $errors, 'truck_load_capacity', 'Грузоподъемность тягача должна быть числом', 'Грузоподъемность тягача не должна превышать 60');
        $this->validateDecimalRange($data, $errors, 'truck_body_volume', 'Объем кузова тягача должен быть числом', 'Объем кузова тягача не должен превышать 150');
        $this->validateDecimalRange($data, $errors, 'trailer_load_capacity', 'Грузоподъемность прицепа должна быть числом', 'Грузоподъемность прицепа не должна превышать 60');
        $this->validateDecimalRange($data, $errors, 'trailer_body_volume', 'Объем кузова прицепа должен быть числом', 'Объем кузова прицепа не должен превышать 150');

        if (empty($data['status']) || !in_array($data['status'], ['active', 'blocked', 'archive'], true)) {
            $errors['status'] = 'Некорректный статус';
        }

        return $errors;
    }

    private function validateDecimalRange(array $data, array &$errors, string $field, string $numericMessage, string $maxMessage): void
    {
        if (empty($data[$field])) {
            return;
        }

        $value = str_replace([',', ' '], ['.', ''], (string) $data[$field]);

        if (!is_numeric($value) || (float) $value < 0) {
            $errors[$field] = $numericMessage;
            return;
        }

        if (
            ($field === 'truck_load_capacity' || $field === 'trailer_load_capacity')
            && (float) $value > 60
        ) {
            $errors[$field] = $maxMessage;
            return;
        }

        if (
            ($field === 'truck_body_volume' || $field === 'trailer_body_volume')
            && (float) $value > 150
        ) {
            $errors[$field] = $maxMessage;
        }
    }
}
