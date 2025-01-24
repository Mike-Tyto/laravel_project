<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal; // Модель Animal для работы с таблицей животных

class FarmController extends Controller
{
    public function index()
    {
        // Получение уникальных номеров ферм из таблицы животных
        $farmNumbers = Animal::select('farm_number')->distinct()->pluck('farm_number');

        // Проверка на пустые фермы
        if ($farmNumbers->isEmpty()) {
            return view('farms.index')->with('message', 'No farms available.');
        }

        return view('farms.index', compact('farmNumbers'));
    }

    public function show(Request $request)
    {
        // Валидируем номер фермы
        $validated = $request->validate([
            'farm_number' => 'required|exists:animals,farm_number',
        ]);

        // Получение всех животных с выбранным номером фермы
        $animals = Animal::where('farm_number', $validated['farm_number'])->get();

        // Обработка отсутствия животных
        if ($animals->isEmpty()) {
            return back()->with('error', 'No animals found for the selected farm.');
        }

        return view('farms.show', [
        'animals' => $animals, 
        'farmNumber' => $validated['farm_number'],
    ]);
    }
}
