<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Support;

final class ContractorContactInputMapper
{
    public static function map(array $data): array
    {
        foreach ($data as $key => $value) {
            if (!is_string($value)) {
                continue;
            }

            $data[$key] = self::cleanupString($value);
        }

        if (!empty($data['full_name'])) {
            $data['full_name'] = self::normalizeName($data['full_name']);
        }

        if (!empty($data['email'])) {
            $data['email'] = self::normalizeEmail($data['email']);
        }

        if (!empty($data['phone'])) {
            $data['phone'] = self::normalizePhone($data['phone']);
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

        foreach ($parts as $index => $part) {
            $part = mb_strtolower($part, 'UTF-8');
            $parts[$index] = mb_convert_case($part, MB_CASE_TITLE, 'UTF-8');
        }

        return implode(' ', $parts);
    }

    private static function normalizeEmail(string $value): string
    {
        $value = self::cleanupString($value);
        $value = preg_replace('/\s+/u', '', $value);

        return mb_strtolower($value, 'UTF-8');
    }

    private static function normalizePhone(string $value): string
    {
        $value = self::cleanupString($value);
        $value = preg_replace('/[^\d\+\s\-\(\)]/u', '', $value);
        $value = preg_replace('/\s+/u', ' ', $value);

        return trim($value);
    }
}
