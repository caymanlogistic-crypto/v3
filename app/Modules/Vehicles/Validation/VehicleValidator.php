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

        if (!empty($data['trailer_plate'])) {
            if (mb_strlen($data['trailer_plate']) < 6 || mb_strlen($data['trailer_plate']) > 20) {
                $errors['trailer_plate'] = 'Госномер прицепа должен содержать от 6 до 20 символов';
            }
        }

        if (!empty($data['trailer_vin']) && mb_strlen($data['trailer_vin']) > 50) {
            $errors['trailer_vin'] = 'VIN прицепа не должен превышать 50 символов';
        }

        if (!empty($data['load_capacity'])) {
            $loadCapacity = str_replace([',', ' '], ['.', ''], $data['load_capacity']);
            if (!is_numeric($loadCapacity) || (float) $loadCapacity < 0) {
                $errors['load_capacity'] = 'Грузоподъёмность должна быть числом';
            }
        }

        if (!empty($data['body_volume'])) {
            $bodyVolume = str_replace([',', ' '], ['.', ''], $data['body_volume']);
            if (!is_numeric($bodyVolume) || (float) $bodyVolume < 0) {
                $errors['body_volume'] = 'Объём кузова должен быть числом';
            }
        }

        if (empty($data['status']) || !in_array($data['status'], ['active', 'blocked', 'archive'], true)) {
            $errors['status'] = 'Некорректный статус';
        }

        return $errors;
    }
}