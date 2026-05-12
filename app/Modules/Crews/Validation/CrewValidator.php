<?php

declare(strict_types=1);

namespace App\Modules\Crews\Validation;

final class CrewValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if ((int) ($data['contractor_id'] ?? 0) <= 0) {
            $errors['contractor_id'] = '�������� ����������';
        }

        if ((int) ($data['driver_id'] ?? 0) <= 0) {
            $errors['driver_id'] = '�������� ��������';
        }

        if ((int) ($data['vehicle_id'] ?? 0) <= 0) {
            $errors['vehicle_id'] = '�������� ������';
        }

        $status = (string) ($data['status'] ?? '');
        if ($status === '' || !in_array($status, ['active', 'inactive', 'archived'], true)) {
            $errors['status'] = '�������� ���������� ������';
        }

        if (!empty($data['comment']) && mb_strlen((string) $data['comment'], 'UTF-8') > 1000) {
            $errors['comment'] = '����������� �� ������ ��������� 1000 ��������';
        }

        return $errors;
    }
}
