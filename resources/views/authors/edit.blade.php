<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">
            Authors
        </h2>
    </x-slot>

    <div class="py-10 space-y-12">

        {{-- ADD AUTHOR --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900/60 backdrop-blur
                        rounded-2xl border border-gray-200/60 dark:border-gray-700/60 shadow-sm">
                <div class="p-6 md:p-8 space-y-8">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">
                        Edit author
                    </h2>

                    <form method="POST" action="{{ route('authors.store') }}" class="space-y-6">
                        @csrf

                        {{-- NAME --}}
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input name="name" value="{{ old('name', $author->name) }}" class="block w-full rounded-xl border-gray-300 dark:border-gray-700
                                       bg-white/60 dark:bg-gray-900/50
                                       text-gray-900 dark:text-gray-100
                                       focus:border-indigo-500 focus:ring-indigo-500 transition">
                            @error('name')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input name="email" value="{{ old('email', $author->email) }}" class="block w-full rounded-xl border-gray-300 dark:border-gray-700
                                       bg-white/60 dark:bg-gray-900/50
                                       text-gray-900 dark:text-gray-100
                                       focus:border-indigo-500 focus:ring-indigo-500 transition">
                            @error('email')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-primary-button class="w-full justify-center py-3 text-base
                                   transition-all duration-200
                                   hover:-translate-y-0.5 hover:shadow-md">
                            Edit author
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>