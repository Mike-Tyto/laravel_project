<x-app-layout>
<x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Записи для фермы №') }} {{ $validated['farm_number'] }}
        </h2>
        <a href="{{ route('farms.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            {{ __('Change farm') }}
        </a>
    </div>
</x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if($animals->isEmpty())
                        <p>Нет записей для этой фермы.</p>
                    @else
                        <table class="min-w-full border-collapse border border-gray-500">
                            <thead>
                                <tr>
                                    <th class="border border-gray-500 px-4 py-2">Имя</th>
                                    <th class="border border-gray-500 px-4 py-2">Порода</th>
                                    <th class="border border-gray-500 px-4 py-2">Дата рождения</th>
                                    <th class="border border-gray-500 px-4 py-2">Номер фермы</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($animals as $animal)
                                    <tr>
                                        <td class="border border-gray-500 px-4 py-2">{{ $animal->name }}</td>
                                        <td class="border border-gray-500 px-4 py-2">{{ $animal->breed }}</td>
                                        <td class="border border-gray-500 px-4 py-2">{{ $animal->birth_date }}</td>
                                        <td class="border border-gray-500 px-4 py-2">{{ $animal->farm_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
