<?php

declare(strict_types=1);

namespace App\Services\WeatherService;

use Illuminate\Support\Facades\Http;

class WeatherService
{

    public static function handle(string $city): array
    {
            $response = Http::get('http://api.weatherapi.com/v1/forecast.json?key='
                . env('API_KEY')
                . '&q=' . $city
                . '&days=1&aqi=no&alerts=yes')->json();

            return $response;
    }

}
