<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Weight;

class AdafruitController extends Controller
{
    public function updateWeight()
    {
        // Конфигурация Adafruit IO
        $username = env('ADAFRUIT_IO_USERNAME'); // Ваш Adafruit IO username
        $apiKey = env('ADAFRUIT_IO_KEY');       // Ваш Adafruit IO API Key
        $feedName = 'weight';                  // Имя фида

        // URL для работы с фидом
        $url = "https://io.adafruit.com/api/v2/{$username}/feeds/{$feedName}/data";

        // Запрос данных из фида
        $response = Http::withHeaders([
            'X-AIO-Key' => $apiKey,
        ])->get($url);

        // Проверка на успешный ответ
        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch data from Adafruit IO'], 500);
        }

        $data = $response->json(); // Массив с данными

        if (empty($data)) {
            return response()->json(['message' => 'No data to process'], 200);
        }

        foreach ($data as $entry) {
            // Разделение строки на rfid и value
            [$rfid, $value] = explode(',', $entry['value']);

            // Сохранение в базу данных
            Weight::create([
                'rfid' => $rfid,           // Идентификатор RFID
                'value' => $value,         // Значение веса
                'timestamp' => date('Y-m-d H:i:s', strtotime($entry['created_at'])), // Временная метка
            ]);

            // Удаление обработанного элемента из фида
            Http::withHeaders([
                'X-AIO-Key' => $apiKey,
            ])->delete("{$url}/{$entry['id']}");
        }

        return response()->json(['message' => 'Data successfully updated'], 200);
    }
}
