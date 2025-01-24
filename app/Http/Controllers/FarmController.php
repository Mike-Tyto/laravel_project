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

        return view('farms.index', compact('farmNumbers'));
    }

    public function show(Request $request)
    {
        $validated = $request->validate([
            'farm_number' => 'required|exists:animals,farm_number',
        ]);

        // Получение всех животных с выбранным номером фермы
        $animals = Animal::where('farm_number', $validated['farm_number'])->get();

        return view('farms.show', compact('animals', 'validated'));
    }
}

