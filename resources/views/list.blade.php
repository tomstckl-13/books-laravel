<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">
            Books
        </h2>
    </x-slot>

    <div class="py-10 space-y-12">

        {{-- ADD BOOK --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900/60 backdrop-blur
                        rounded-2xl border border-gray-200/60 dark:border-gray-700/60 shadow-sm">
                <div class="p-6 md:p-8 space-y-8">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">
                        Add book
                    </h2>

                    <form method="POST" action="{{ route('books.store') }}" class="space-y-6">
                        @csrf

                        {{-- ISBN --}}
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">ISBN</label>
                            <input name="isbn" value="{{ old('isbn') }}" class="block w-full rounded-xl border-gray-300 dark:border-gray-700
                                       bg-white/60 dark:bg-gray-900/50
                                       text-gray-900 dark:text-gray-100
                                       focus:border-indigo-500 focus:ring-indigo-500 transition">
                        </div>

                        {{-- TITLE --}}
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input name="title" value="{{ old('title') }}" class="block w-full rounded-xl border-gray-300 dark:border-gray-700
                                       bg-white/60 dark:bg-gray-900/50
                                       text-gray-900 dark:text-gray-100
                                       focus:border-indigo-500 focus:ring-indigo-500 transition">
                        </div>

                        {{-- PAGES --}}
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Pages</label>
                            <input name="pages" type="number" value="{{ old('pages') }}" class="block w-full rounded-xl border-gray-300 dark:border-gray-700
                                       bg-white/60 dark:bg-gray-900/50
                                       text-gray-900 dark:text-gray-100
                                       focus:border-indigo-500 focus:ring-indigo-500 transition">
                        </div>

                        <x-primary-button class="w-full justify-center py-3 text-base
                                   transition-all duration-200
                                   hover:-translate-y-0.5 hover:shadow-md">
                            Save book
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>

        {{-- BOOK LIST --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900/60 backdrop-blur
                        rounded-2xl border border-gray-200/60 dark:border-gray-700/60 shadow-sm">
                <div class="p-6 md:p-8 space-y-8">

                    {{-- FLASH MESSAGES --}}
                    @if (session('success'))
                        <div class="flex items-center gap-3 rounded-xl
                                        bg-lime-50/80 dark:bg-lime-900/20 px-4 py-3">
                            <div class="w-2 h-2 rounded-full bg-lime-500"></div>
                            <p class="text-lime-700 dark:text-lime-400 font-medium">
                                {{ session('success') }}
                            </p>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="flex items-center gap-3 rounded-xl
                                        bg-red-50/80 dark:bg-red-900/20 px-4 py-3">
                            <div class="w-2 h-2 rounded-full bg-red-500"></div>
                            <p class="text-red-700 dark:text-red-400 font-medium">
                                {{ session('error') }}
                            </p>
                        </div>
                    @endif

                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">
                            Books
                        </h2>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $books->count() }} total
                        </span>
                    </div>

                    <div class="space-y-3">
                        @forelse ($books as $book)
                            <div class="group relative overflow-hidden rounded-xl
                                            bg-white/50 dark:bg-gray-900/40
                                            transition-all duration-300
                                            hover:shadow-md hover:-translate-y-0.5
                                            hover:bg-gray-50 dark:hover:bg-gray-800/70">

                                <div class="flex items-center gap-4 px-4 py-3 pr-14">
                                    <div class="flex-1 space-y-0.5">
                                        <p
                                            class="font-bold text-gray-900 dark:text-gray-100
                                                      group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ $book->title }}
                                        </p>
                                        <p class="text-xs text-gray-500 tracking-wide">
                                            ISBN: {{ $book->isbn }}
                                        </p>
                                        @if($book->author?->name)
                                            <p class="text-xs text-gray-500 tracking-wide">
                                                {{$book->author->name}}
                                            </p>
                                        @else
                                            <p class="text-xs text-gray-500 tracking-wide">
                                                Kein Autor vorhanden
                                            </p>
                                        @endif

                                    </div>

                                    <span class="shrink-0 text-xs font-medium px-2.5 py-1 rounded-full
                                                     bg-gray-100 dark:bg-gray-800
                                                     text-gray-700 dark:text-gray-300
                                                     group-hover:bg-indigo-100 dark:group-hover:bg-indigo-900/40
                                                     group-hover:text-indigo-700 dark:group-hover:text-indigo-300
                                                     transition-all duration-300
                                                     group-hover:-translate-x-12">
                                        {{ $book->pages }} pages
                                    </span>
                                </div>

                                {{-- ACTIONS --}}
                                <div class="absolute inset-y-0 right-0 flex items-center gap-2
                                                translate-x-full group-hover:translate-x-0
                                                transition-all duration-300 ease-out pr-3">

                                    <a href="{{ route('books.edit', $book) }}" class="w-9 h-9 flex items-center justify-center rounded-lg
                                                  text-indigo-400 hover:text-indigo-600
                                                  hover:bg-indigo-500/10 dark:hover:text-indigo-300 transition">
                                        <x-pencil class="w-5 h-5" />
                                    </a>

                                    <form method="POST" action="{{ route('books.delete', $book) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="w-9 h-9 flex items-center justify-center rounded-lg
                                                       bg-red-500/10 text-red-500
                                                       hover:bg-red-500 hover:text-white transition">
                                            <x-trash class="w-5 h-5" />
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 dark:text-gray-400">
                                No books found.
                            </p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-app-layout>
