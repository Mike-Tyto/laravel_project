<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Weight Data for RFID: ') }} {{ $rfid }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Weight Chart</h3>

                    <!-- Встраивание графика -->
                    <img src="{{ route('plot.image', ['rfid' => $rfid]) }}" alt="Weight Chart" class="w-full h-auto">

                    <h3 class="text-lg font-semibold mb-4 mt-6">Weight Data</h3>

                    <!-- Таблица с данными -->
                    @if ($weights->isEmpty())
                        <p>No data available for this RFID.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Timestamp
                                    </th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Weight
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                @foreach ($weights as $weight)
                                    <tr>
                                        <td class="px-4 py-2 text-sm text-gray-500 dark:text-gray-300">
                                            {{ $weight->timestamp }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-500 dark:text-gray-300">
                                            {{ $weight->value }}
                                        </td>
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
