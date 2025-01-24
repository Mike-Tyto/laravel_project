<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AdafruitService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.adafruit.key');
        $this->baseUrl = 'https://io.adafruit.com/api/v2';
    }

    /**
     * Получить значения из фида.
     *
     * @param string $username
     * @param string $feedName
     * @return array
     */
    public function getFeedData(string $username, string $feedName): array
    {
        $response = Http::withHeaders([
            'X-AIO-Key' => $this->apiKey,
        ])->get("{$this->baseUrl}/{$username}/feeds/{$feedName}/data");

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }
}
