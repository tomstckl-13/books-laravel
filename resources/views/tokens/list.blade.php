<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tokens') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Erfolgsmeldung und Token-Anzeige --}}
            @if (session('success'))
                <div class="bg-indigo-50 border rounded-lg border-indigo-200 p-4 text-sm text-indigo-700 mb-3">
                    <p>{{ session('success') }}</p>
                    @if (session()->has('token'))
                        <p class="mt-2 font-mono font-bold bg-white p-2 rounded border border-indigo-100">
                            {{ __('Your token: :token', ['token' => session('token')]) }}
                        </p>
                    @endif
                </div>
            @endif

            {{-- Token erstellen Formular --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('token.store') }}" class="bg-white border border-slate-200 rounded-lg p-6 space-y-5">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium text-slate-700">{{ __('Title') }}</label>
                        <input id="title" name="title" type="text" required value="{{ old('title') }}"
                               class="mt-1 block w-full rounded-md border-slate-300 text-slate-900 focus:border-indigo-500 focus:ring-indigo-500" />
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Abilities / Berechtigungen --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            {{ __('Abilities') }}
                        </label>

                        @error('abilities')
                        <p class="mb-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="space-y-3">
                            @php
                                $availableAbilities = [
                                    'bookmark:list' => 'List bookmarks',
                                    'bookmark:create' => 'Create bookmarks',
                                    'bookmark:edit' => 'Edit bookmarks',
                                    'bookmark:delete' => 'Delete bookmarks',
                                ];
                            @endphp

                            @foreach($availableAbilities as $value => $label)
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" name="abilities[]" value="{{ $value }}"
                                           @checked(is_array(old('abilities')) && in_array($value, old('abilities')))
                                           class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" />
                                    <span class="text-sm text-slate-700">{{ __($label) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>
                            {{ __('Create token') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            {{-- Token Liste --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-3">
                    @if($tokens->isEmpty())
                        <p>{{ __('Please add a token.') }}</p>
                    @else
                        @foreach ($tokens as $token)
                            <div class="bg-white border border-slate-200 rounded-lg p-5 flex flex-col md:flex-row justify-between items-center">
                                <div>
                                    <h2 class="text-lg font-semibold text-indigo-600 leading-tight">
                                        {{ $token->name }}
                                    </h2>
                                </div>
                                <div class="flex flex-row space-x-3 mt-3 md:mt-0">
                                    <form action="{{ route('token.destroy', $token) }}" method="post" onsubmit="return confirm('Wirklich löschen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <x-trash />
                                            <span class="sr-only">{{ __('Remove token') }}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                {{-- Pagination --}}
                @if($tokens->hasPages())
                    <div class="p-6 border-t border-gray-100">
                        {{ $tokens->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
