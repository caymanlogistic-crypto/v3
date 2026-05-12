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

        $dateFields = [
            'passport_issue_date',
            'license_issue_date',
        ];

        foreach ($dateFields as $field) {
            if (!empty($data[$field])) {
                $data[$field] = self::normalizeDateToIso($data[$field]);
            }
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

    private static function normalizeDateToIso(string $value): string
    {
        $raw = self::cleanupString($value);
        if ($raw === '') {
            return '';
        }

        $parts = self::parseDateParts($raw);
        if ($parts === null) {
            return $raw;
        }

        [$year, $month, $day] = $parts;

        if (!checkdate($month, $day, $year)) {
            return $raw;
        }

        return sprintf('%04d-%02d-%02d', $year, $month, $day);
    }

    /**
     * @return array{0:int,1:int,2:int}|null [year, month, day]
     */
    private static function parseDateParts(string $raw): ?array
    {
        $digits = preg_replace('/\D/', '', $raw);

        if (strlen($digits) === 8) {
            if (preg_match('/^\d{4}[-\/]\d{2}[-\/]\d{2}$/', $raw) === 1) {
                return [
                    (int) substr($digits, 0, 4),
                    (int) substr($digits, 4, 2),
                    (int) substr($digits, 6, 2),
                ];
            }

            return [
                (int) substr($digits, 4, 4),
                (int) substr($digits, 2, 2),
                (int) substr($digits, 0, 2),
            ];
        }

        $chunks = preg_split('/[.,\/-]/', $raw, -1, PREG_SPLIT_NO_EMPTY);
        if (!is_array($chunks) || count($chunks) !== 3) {
            return null;
        }

        if (strlen($chunks[0]) === 4) {
            return [
                (int) $chunks[0],
                (int) $chunks[1],
                (int) $chunks[2],
            ];
        }

        return [
            (int) $chunks[2],
            (int) $chunks[1],
            (int) $chunks[0],
        ];
    }
}
