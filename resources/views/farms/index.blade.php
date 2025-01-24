<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Выберите номер фермы') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('farms.show') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="farm_number" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Выберите номер фермы:
                            </label>
                            <select id="farm_number" name="farm_number" class="mt-1 block w-full rounded-md shadow-sm text-black">
                                <option value="" disabled selected>Выберите...</option>
                                @foreach($farmNumbers as $farmNumber)
                                    <option value="{{ $farmNumber }}">{{ $farmNumber }}</option>
                                @endforeach
                            </select>
                            @error('farm_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Показать записи
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
