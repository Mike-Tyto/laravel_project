<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class AnimalController extends Controller
{
    // Отображение формы
    public function create()
    {
        return view('animals.create');
    }

    // Сохранение записи в базу данных
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'breed' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'farm_number' => ['required', 'string', 'max:255'],
        ]);

        Animal::create($validated);

        return redirect()->route('animals.create')->with('success', 'Запись успешно добавлена!');
    }

    public function showImportForm()
    {
        return view('animals.import');
    }

    public function importFromCsv(Request $request)
    {
        // Проверка на наличие загруженного файла
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Получение файла
        $file = $request->file('csv_file');
        $data = array_map('str_getcsv', file($file->getRealPath()));

        // Проверка на наличие данных
        if (empty($data) || count($data) < 2) {
            return redirect()->back()->with('error', 'Файл пуст или имеет неверный формат.');
        }

        // Извлечение заголовков и строк данных
        $headers = array_map('trim', $data[0]);
        $rows = array_slice($data, 1);

        // Убедитесь, что CSV содержит нужные колонки
        $expectedHeaders = ['name', 'breed', 'birth_date', 'farm_number'];
        if (array_diff($expectedHeaders, $headers)) {
            return redirect()->back()->with('error', 'Неверный формат CSV. Требуемые колонки: name, breed, birth_date, farm_number.');
        }

        // Обработка данных
        foreach ($rows as $row) {
            $row = array_combine($headers, $row);

            // Валидация данных строки
            $validator = Validator::make($row, [
                'name' => 'required|string|max:255',
                'breed' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'farm_number' => 'required|integer',
            ]);

            if ($validator->fails()) {
                // Пропустить строку с ошибками
                continue;
            }

            // Добавление животного в базу данных
            Animal::create([
                'name' => $row['name'],
                'breed' => $row['breed'],
                'birth_date' => $row['birth_date'],
                'farm_number' => $row['farm_number'],
            ]);
        }

        return redirect()->route('animals.create')->with('success', 'Животные успешно импортированы.');
    }

    public function showDuplicates()
    {
        // Найти дублирующиеся записи по имени и дате рождения
        $duplicates = Animal::select('name', 'birth_date', DB::raw('COUNT(*) as count'))
            ->groupBy('name', 'birth_date')
            ->having('count', '>', 1)
            ->get();

        return view('animals.duplicates', compact('duplicates'));
    }

    public function removeDuplicates()
    {
        // Удалить дубли, оставив только одну запись
        $duplicates = Animal::select('name', 'birth_date', DB::raw('MIN(id) as keep_id'))
            ->groupBy('name', 'birth_date')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicates as $duplicate) {
            Animal::where('name', $duplicate->name)
                ->where('birth_date', $duplicate->birth_date)
                ->where('id', '!=', $duplicate->keep_id)
                ->delete();
        }

        return redirect()->route('animals.duplicates')->with('success', 'Duplicate animals removed successfully.');
    }

}
