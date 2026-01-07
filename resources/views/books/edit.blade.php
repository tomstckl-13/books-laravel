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
                        Edit book
                    </h2>

                    <form method="POST" action="{{ route('books.update', $book->id) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        {{-- ISBN --}}
                        <div class="space-y-1">
                            <label for="isbn" class="text-sm font-medium text-gray-700 dark:text-gray-300">ISBN</label>
                            <input name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}"
                                   class="block w-full rounded-xl border-gray-300 dark:border-gray-700
                      bg-white/60 dark:bg-gray-900/50
                      text-gray-900 dark:text-gray-100
                      focus:border-indigo-500 focus:ring-indigo-500 transition">
                            @error('isbn')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- TITLE --}}
                        <div class="space-y-1">
                            <label for="title" class="text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input name="title" id="title" value="{{ old('title', $book->title) }}"
                                   class="block w-full rounded-xl border-gray-300 dark:border-gray-700
                      bg-white/60 dark:bg-gray-900/50
                      text-gray-900 dark:text-gray-100
                      focus:border-indigo-500 focus:ring-indigo-500 transition">
                            @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- AUTHOR DROPDOWN --}}
                        <div class="space-y-1">
                            <label for="author_id" class="text-sm font-medium text-gray-700 dark:text-gray-300">Author</label>
                            <select name="author_id" id="author_id"
                                    class="block w-full rounded-xl border-gray-300 dark:border-gray-700
                       bg-white/60 dark:bg-gray-900/50
                       text-gray-900 dark:text-gray-100
                       focus:border-indigo-500 focus:ring-indigo-500 transition">
                                <option value="">Select an Author</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}"
                                        {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- PAGES --}}
                        <div class="space-y-1">
                            <label for="pages" class="text-sm font-medium text-gray-700 dark:text-gray-300">Pages</label>
                            <input name="pages" id="pages" type="number" value="{{ old('pages', $book->pages) }}"
                                   class="block w-full rounded-xl border-gray-300 dark:border-gray-700
                      bg-white/60 dark:bg-gray-900/50
                      text-gray-900 dark:text-gray-100
                      focus:border-indigo-500 focus:ring-indigo-500 transition">
                            @error('pages')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-primary-button class="w-full justify-center py-3 text-base
               transition-all duration-200
               hover:-translate-y-0.5 hover:shadow-md">
                            Update Book
                        </x-primary-button>
                    </form>
                    @if (session('success'))
                        <div class="flex items-center gap-3 rounded-xl
                                            bg-lime-50/80 dark:bg-lime-900/20 px-4 py-3">
                            <div class="w-2 h-2 rounded-full bg-lime-500"></div>
                            <p class="text-lime-700 dark:text-lime-400 font-medium">
                                {{ session('success') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
