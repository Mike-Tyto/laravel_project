<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Weight Data</h3>
                    @if($weights->isNotEmpty())
                        <table class="table-auto w-full border-collapse border border-gray-500">
                            <thead>
                                <tr>
                                    <th class="border border-gray-500 px-4 py-2">RFID</th>
                                    <th class="border border-gray-500 px-4 py-2">Value</th>
                                    <th class="border border-gray-500 px-4 py-2">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($weights as $weight)
                                    <tr>
                                        <td class="border border-gray-500 px-4 py-2">{{ $weight->rfid }}</td>
                                        <td class="border border-gray-500 px-4 py-2">{{ $weight->value }}</td>
                                        <td class="border border-gray-500 px-4 py-2">{{ $weight->timestamp }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No weight data available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
