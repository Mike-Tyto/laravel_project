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
                    <h3 class="text-lg font-semibold mb-4">Feed Data from Adafruit IO</h3>
                    @if(!empty($feedData))
                        <ul>
                            @foreach ($feedData as $data)
                                <li>
                                    <strong>Value:</strong> {{ $data['value'] }} |
                                    <strong>Created at:</strong> {{ $data['created_at'] }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No data available for this feed.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
