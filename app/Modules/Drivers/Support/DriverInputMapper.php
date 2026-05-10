<?php

declare(strict_types=1);

namespace App\Modules\Drivers\Support;

final class DriverInputMapper
{
    public static function map(array $data): array
    {
        foreach ($data as $key => $value) {
            if (!is_string($value)) {
                continue;
            }

            $data[$key] = self::cleanupString($value);
        }

        $numericFields = [
            'passport_number',
            'license_number',
            'snils',
        ];

        foreach ($numericFields as $field) {
            if (isset($data[$field])) {
                $data[$field] = preg_replace('/[^\d]/', '', $data[$field]);
            }
        }

        if (!empty($data['email'])) {
            $data['email'] = self::cleanupString($data['email']);
            $data['email'] = mb_strtolower(
                preg_replace('/\s+/u', '', $data['email']),
                'UTF-8'
            );
        }

        if (!empty($data['full_name'])) {
            $data['full_name'] = self::normalizeName($data['full_name']);
        }

        return $data;
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

        return trim($value);
    }

    private static function normalizeName(string $value): string
    {
        $value = self::cleanupString($value);

        $parts = preg_split('/\s+/u', $value, -1, PREG_SPLIT_NO_EMPTY);

        $normalized = [];

        foreach ($parts as $part) {
            $part = mb_strtolower($part, 'UTF-8');
            $normalized[] = mb_convert_case($part, MB_CASE_TITLE, 'UTF-8');
        }

        return implode(' ', $normalized);
    }
}
