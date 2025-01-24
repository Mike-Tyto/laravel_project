<x-app-layout>
    <x-slot name="header">
        <div class="relative inline-block text-left">
            <button type="button"
                class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                id="menu-button" aria-expanded="false" aria-haspopup="true" onclick="toggleMenu()">
                {{ __('Sent Messages') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 -mr-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.354a.75.75 0 111.14.976l-4 4.5a.75.75 0 01-1.14 0l-4-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdown-menu"
                class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1" role="none">
                    <a href="{{ route('messages.inbox') }}"
                        class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
                        role="menuitem" tabindex="-1" id="inbox-option">
                        {{ __('Inbox Messages') }}
                    </a>
                    <a href="{{ route('messages.sent') }}"
                        class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
                        role="menuitem" tabindex="-1" id="sent-option">
                        {{ __('Sent Messages') }}
                    </a>
                    <a href="{{ route('messages.create') }}"
                        class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
                        role="menuitem" tabindex="-1" id="inbox-option">
                        {{ __('Write a message') }}
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ __('Your Sent Messages') }}</h3>

                    @if ($messages->isEmpty())
                        <p class="mt-4">{{ __('No sent messages.') }}</p>
                    @else
                        <ul class="mt-4 space-y-4">
                            @foreach ($messages as $message)
                                <li class="border-b border-gray-300 dark:border-gray-700 pb-4">
                                    <p><strong>{{ __('To:') }}</strong> {{ $message->receiver->name }}</p>
                                    <p><strong>{{ __('Message:') }}</strong> {{ $message->content }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $message->created_at->format('d.m.Y H:i') }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
