<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Farm;

class AnimalTransferController extends Controller
{
    // Форма для перевода животного
    public function showTransferForm($id)
    {
        $animal = Animal::findOrFail($id);
        
        // Получить список всех ферм, кроме текущей
        $farmNumbers = Animal::select('farm_number')
                     ->distinct()
                     ->where('farm_number', '!=', $animal->farm_number)
                     ->pluck('farm_number');
        return view('animals.transfer', compact('animal', 'farmNumbers'));
    }

    // Обработка перевода животного
    public function transfer(Request $request, $id)
    {
        // Найти животное по ID
        $animal = Animal::findOrFail($id);
    
        // Сохранить текущий номер фермы
        $originalFarmNumber = $animal->farm_number;
    
        // Валидировать данные запроса
        $validated = $request->validate([
            'farm_number' => 'required|exists:animals,farm_number', // Проверяем, что номер фермы существует
        ]);
    
        // Обновить номер фермы животного
        $animal->farm_number = $validated['farm_number'];
        $animal->save();
    
        // Получение всех животных на исходной ферме
        $animals = Animal::where('farm_number', $originalFarmNumber)->get();
        
        // Переадресация на страницу исходной фермы
        return view('farms.show', [
            'animals' => $animals,
            'farmNumber' => $originalFarmNumber,
        ]);
    }
    
}
