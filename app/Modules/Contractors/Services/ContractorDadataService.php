<?php

declare(strict_types=1);

namespace App\Modules\Contractors\Services;

final class ContractorDadataService
{
    public function lookupByInn(string $inn): ?array
    {
        $token = config('dadata.token');
        if (empty($token)) {
            return null;
        }

        $url = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party';
        $data = json_encode(['query' => $inn]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Token ' . $token,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200 || !$response) {
            return null;
        }

        $json = json_decode($response, true);
        if (!$json || !isset($json['suggestions']) || empty($json['suggestions'])) {
            return null;
        }

        $suggestion = $json['suggestions'][0]['data'];

        return [
            'name' => $suggestion['name']['short_with_opf'] ?? $suggestion['name']['full_with_opf'] ?? '',
            'inn' => $suggestion['inn'] ?? '',
            'kpp' => $suggestion['kpp'] ?? '',
            'ogrn' => $suggestion['ogrn'] ?? '',
            'okved' => $suggestion['okved'] ?? '',
            'legal_address' => $suggestion['address']['value'] ?? '',
            'director' => $suggestion['management']['name'] ?? '',
            'director_post' => $suggestion['management']['post'] ?? '',
        ];
    }
}