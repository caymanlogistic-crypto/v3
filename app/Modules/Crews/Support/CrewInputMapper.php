<?php

declare(strict_types=1);

namespace App\Modules\Crews\Support;

final class CrewInputMapper
{
    public static function map(array $data): array
    {
        $mapped = [];

        $mapped['contractor_id'] = self::toInt($data['contractor_id'] ?? null);
        $mapped['driver_id'] = self::toInt($data['driver_id'] ?? null);
        $mapped['vehicle_id'] = self::toInt($data['vehicle_id'] ?? null);
        $mapped['status'] = trim((string) ($data['status'] ?? 'active'));
        $mapped['comment'] = self::cleanupString((string) ($data['comment'] ?? ''));

        return $mapped;
    }

    private static function toInt(mixed $value): int
    {
        if (is_numeric($value)) {
            return (int) $value;
        }

        return 0;
    }

    private static function cleanupString(string $value): string
    {
        $value = str_replace([
            "\t",
            "\xC2\xA0",
            "\xE2\x80\xA8",
            "\xE2\x80\xA9",
        ], ' ', $value);

        $value = preg_replace('/[\x{00A0}]/u', ' ', $value);
        $value = preg_replace('/\s+/u', ' ', $value);

        return trim((string) $value);
    }
}
