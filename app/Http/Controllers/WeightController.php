<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight;

class WeightController extends Controller
{
    public function selectRfid()
    {
        $rfids = Weight::select('rfid')->distinct()->pluck('rfid');
        return view('weights.select', compact('rfids'));
    }

    public function plotWeight(Request $request)
    {
        $rfid = $request->input('rfid');

        // Получаем данные для выбранного RFID
        $weights = Weight::where('rfid', $rfid)
            ->orderBy('timestamp', 'asc')
            ->get(['timestamp', 'value']);

        // Создаем CSV-файл для передачи в Python
        $csvPath = storage_path('app/weights.csv');
        $file = fopen($csvPath, 'w');
        fputcsv($file, ['timestamp', 'value']);
        foreach ($weights as $weight) {
            fputcsv($file, [$weight->timestamp, $weight->value]);
        }
        fclose($file);

        // Генерируем график с помощью Python
        $outputPath = storage_path('app/weight_plot.png');
        $command = escapeshellcmd("python3 " . base_path('scripts/plot_weight.py') . " $csvPath $outputPath");
        shell_exec($command);

        // Передаем путь к изображению в Blade-шаблон
        return view('weights.plot', [
            'rfid' => $rfid,
            'imagePath' => asset('storage/weight_plot.png'),
            'weights' => $weights,
        ]);
    }
}
