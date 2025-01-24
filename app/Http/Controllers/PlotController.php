<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PlotController extends Controller
{
    public function generatePlot($rfid)
    {
        // Получение данных из таблицы weights для указанного RFID
        $weights = Weight::where('rfid', $rfid)->orderBy('timestamp')->get();

        if ($weights->isEmpty()) {
            abort(404, 'No data available for this RFID');
        }

        // Формирование данных для передачи Python-скрипту
        $data = $weights->map(function ($weight) {
            return [
                'timestamp' => $weight->timestamp,
                'value' => $weight->value,
            ];
        });

        // Подготовка данных в JSON для передачи в Python
        $jsonData = $data->toJson();

        // Путь к Python-скрипту
        $pythonScriptPath = base_path('scripts/plot_weight.py'); // Убедитесь, что путь корректный

        // Запуск Python-скрипта через Process
        $process = new Process(['python3', $pythonScriptPath, $jsonData]);
        try {
            $process->mustRun();
        } catch (ProcessFailedException $exception) {
            return response('Error generating plot: ' . $exception->getMessage(), 500);
        }

        // Возврат результата (графика) как изображения
        return response($process->getOutput(), 200, [
            'Content-Type' => 'image/png',
        ]);
    }
}

