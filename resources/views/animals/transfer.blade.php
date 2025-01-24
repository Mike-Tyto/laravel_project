<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transfer Animal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Transfer Animal: {{ $animal->name }}</h3>
                    <form method="POST" action="{{ route('animals.transfer', $animal->id) }}">
                        @csrf

                        <div class="mb-4">
                            <label for="farm_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Select New Farm') }}
                            </label>
                            <select id="farm_number" name="farm_number" required
                                class="block w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="" disabled selected>{{ __('Select a farm') }}</option>
                                @foreach ($farmNumbers as $farmNumber)
                                    <option value="{{ $farmNumber }}">{{ $farmNumber }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Transfer Animal') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
