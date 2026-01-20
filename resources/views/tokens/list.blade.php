<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">
            Tokens
        </h2>
    </x-slot>

    <div class="py-10 space-y-12">

        {{-- ADD AUTHOR --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900/60 backdrop-blur
                        rounded-2xl border border-gray-200/60 dark:border-gray-700/60 shadow-sm">
                <div class="p-6 md:p-8 space-y-8">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">
                        Add Token
                    </h2>

                    <form method="POST" action="{{ route('token.store') }}" class="space-y-6">
                        @csrf

                        {{-- NAME --}}
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Token Name</label>
                            <input name="title" value="{{ old('title') }}" class="block w-full rounded-xl border-gray-300 dark:border-gray-700
                                       bg-white/60 dark:bg-gray-900/50
                                       text-gray-900 dark:text-gray-100
                                       focus:border-indigo-500 focus:ring-indigo-500 transition">
                            @error('title')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>



                        <x-primary-button class="w-full justify-center py-3 text-base
                                   transition-all duration-200
                                   hover:-translate-y-0.5 hover:shadow-md">
                            Save Token
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>



        {{-- AUTHORS LIST --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-indigo-50 border-rounded-lg p-4 text-indigo-700 mb-3">
                    <p>
                        {{session('success')}}
                    </p>

                        @if(session()->has('token'))
                            <p>
                                Your Token: {{session('token')}}
                            </p>
                        @endif

                </div>
            @endif
            <div>

            </div>
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
                            Tokens
                        </h2>
                        <div>

                        </div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{--// Anzahl der tokens--}}
                        </span>
                    </div>

                    <div class="space-y-3 text-white">
                        @foreach($tokens as $token)
                            <div class="flex flex-row justify-between border-2 border-white p-4 ">
                                <h1>
                                    {{$token->name}}
                                </h1>

                                <form method="POST" action="{{route('token.destroy', $token->id)}}">
                                    @method('DELETE')
                                    @csrf
                                    <x-primary-button>
                                        Delete
                                    </x-primary-button>
                                </form>
                            </div>

                        @endforeach
                            <div>
                                {{$tokens->links()}}
                            </div>
                    </div>



                </div>
            </div>
        </div>

    </div>
</x-app-layout>
