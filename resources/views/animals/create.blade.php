<x-app-layout>
    <x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Добавить животное') }}
        </h2>
        <a href="{{ route('animals.duplicates') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            {{ __('Show duplicates') }}
        </a>
    </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('animals.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Имя</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md shadow-sm text-black" value="{{ old('name') }}" required>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="breed" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Порода</label>
                            <input type="text" id="breed" name="breed" class="mt-1 block w-full rounded-md shadow-sm text-black" value="{{ old('breed') }}" required>
                            @error('breed') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="birth_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Дата рождения</label>
                            <input type="date" id="birth_date" name="birth_date" class="mt-1 block w-full rounded-md shadow-sm text-black" value="{{ old('birth_date') }}" required>
                            @error('birth_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="farm_number" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Номер фермы</label>
                            <input type="text" id="farm_number" name="farm_number" class="mt-1 block w-full rounded-md shadow-sm text-black" value="{{ old('farm_number') }}" required>
                            @error('farm_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Добавить
                            </button>

                            <a href="{{ route('animals.import.form') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Import CSV') }}
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
