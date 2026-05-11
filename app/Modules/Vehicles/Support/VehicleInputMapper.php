<?php

declare(strict_types=1);

namespace App\Modules\Vehicles\Support;

final class VehicleInputMapper
{
    public static function map(array $data): array
    {
        foreach ($data as $key => $value) {
            if (!is_string($value)) {
                continue;
            }

            $data[$key] = self::cleanupString($value);
        }

        if (!empty($data['truck_plate'])) {
            $data['truck_plate'] = mb_strtoupper($data['truck_plate']);
            $data['truck_plate'] = preg_replace('/\s+/', '', $data['truck_plate']);
        }

        if (!empty($data['trailer_plate'])) {
            $data['trailer_plate'] = mb_strtoupper($data['trailer_plate']);
            $data['trailer_plate'] = preg_replace('/\s+/', '', $data['trailer_plate']);
        }

        if (!empty($data['truck_vin'])) {
            $data['truck_vin'] = mb_strtoupper($data['truck_vin']);
            $data['truck_vin'] = preg_replace('/\s+/', '', $data['truck_vin']);
        }

        if (!empty($data['trailer_vin'])) {
            $data['trailer_vin'] = mb_strtoupper($data['trailer_vin']);
            $data['trailer_vin'] = preg_replace('/\s+/', '', $data['trailer_vin']);
        }

        if (!empty($data['truck_load_capacity'])) {
            $data['truck_load_capacity'] = self::normalizeNumeric($data['truck_load_capacity']);
        }

        if (!empty($data['truck_body_volume'])) {
            $data['truck_body_volume'] = self::normalizeNumeric($data['truck_body_volume']);
        }

        if (!empty($data['trailer_load_capacity'])) {
            $data['trailer_load_capacity'] = self::normalizeNumeric($data['trailer_load_capacity']);
        }

        if (!empty($data['trailer_body_volume'])) {
            $data['trailer_body_volume'] = self::normalizeNumeric($data['trailer_body_volume']);
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

    private static function normalizeNumeric(string $value): string
    {
        $value = str_replace([',', ' '], ['.', ''], $value);
        return $value;
    }
}
