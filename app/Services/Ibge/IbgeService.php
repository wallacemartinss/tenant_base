<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IbgeService
{
    public static function getStates(): array
    {
        $response = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados');

        if ($response->failed()) {
            return [];
        }

        return collect($response->json())
            ->sortBy('nome')
            ->pluck('nome', 'sigla')
            ->toArray();
    }

    public static function getCitiesByState(string $state): array
    {
        $response = Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$state}/municipios");

        if ($response->failed()) {
            return [];
        }

        return collect($response->json())
            ->sortBy('nome')
            ->pluck('nome', 'nome') // Cria um array [nome => nome]
            ->toArray();
    }
}
