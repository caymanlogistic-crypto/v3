<?php

declare(strict_types=1);

namespace App\Modules\Crews\Validation;

final class CrewValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if ((int) ($data['contractor_id'] ?? 0) <= 0) {
            $errors['contractor_id'] = "\u{0412}\u{044B}\u{0431}\u{0435}\u{0440}\u{0438}\u{0442}\u{0435} \u{043F}\u{043E}\u{0434}\u{0440}\u{044F}\u{0434}\u{0447}\u{0438}\u{043A}\u{0430}";
        }

        if ((int) ($data['driver_id'] ?? 0) <= 0) {
            $errors['driver_id'] = "\u{0412}\u{044B}\u{0431}\u{0435}\u{0440}\u{0438}\u{0442}\u{0435} \u{0432}\u{043E}\u{0434}\u{0438}\u{0442}\u{0435}\u{043B}\u{044F}";
        }

        if ((int) ($data['vehicle_id'] ?? 0) <= 0) {
            $errors['vehicle_id'] = "\u{0412}\u{044B}\u{0431}\u{0435}\u{0440}\u{0438}\u{0442}\u{0435} \u{043C}\u{0430}\u{0448}\u{0438}\u{043D}\u{0443}";
        }

        $status = (string) ($data['status'] ?? '');
        if ($status === '' || !in_array($status, ['active', 'inactive', 'archived'], true)) {
            $errors['status'] = "\u{0412}\u{044B}\u{0431}\u{0435}\u{0440}\u{0438}\u{0442}\u{0435} \u{043A}\u{043E}\u{0440}\u{0440}\u{0435}\u{043A}\u{0442}\u{043D}\u{044B}\u{0439} \u{0441}\u{0442}\u{0430}\u{0442}\u{0443}\u{0441}";
        }

        if (!empty($data['comment']) && mb_strlen((string) $data['comment'], 'UTF-8') > 1000) {
            $errors['comment'] = "\u{041A}\u{043E}\u{043C}\u{043C}\u{0435}\u{043D}\u{0442}\u{0430}\u{0440}\u{0438}\u{0439} \u{043D}\u{0435} \u{0434}\u{043E}\u{043B}\u{0436}\u{0435}\u{043D} \u{043F}\u{0440}\u{0435}\u{0432}\u{044B}\u{0448}\u{0430}\u{0442}\u{044C} 1000 \u{0441}\u{0438}\u{043C}\u{0432}\u{043E}\u{043B}\u{043E}\u{0432}";
        }

        return $errors;
    }
}
