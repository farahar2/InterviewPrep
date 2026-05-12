<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-dark-900 text-white">
        <div class="min-h-screen">
            <!-- Navigation -->
            <nav class="bg-dark-800 border-b border-dark-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-white">
                                    Interview<span class="text-status-mastered">Prep</span>
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <a href="{{ route('dashboard') }}" 
                                   class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out
                                   {{ request()->routeIs('dashboard') ? 'border-status-mastered text-white' : 'border-transparent text-dark-300 hover:text-white hover:border-dark-500' }}">
                                    Dashboard
                                </a>
                                <a href="{{ route('domains.index') }}" 
                                   class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out
                                   {{ request()->routeIs('domains.*') ? 'border-status-mastered text-white' : 'border-transparent text-dark-300 hover:text-white hover:border-dark-500' }}">
                                    Technical Domains
                                </a>
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" 
                                        class="flex items-center text-sm font-medium text-dark-300 hover:text-white focus:outline-none transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>
                                    <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="open" 
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-dark-700 ring-1 ring-black ring-opacity-5 z-50"
                                     style="display: none;">
                                    <div class="py-1">
                                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-dark-300 hover:bg-dark-600 hover:text-white">
                                            Profile
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-dark-300 hover:bg-dark-600 hover:text-white">
                                                Log Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-dark-800 border-b border-dark-700">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Messages Flash -->
                    @if (session('success'))
                        <div x-data="{ show: true }" 
                             x-show="show" 
                             x-init="setTimeout(() => show = false, 3000)"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="mb-6 bg-status-mastered/10 border border-status-mastered text-status-mastered px-4 py-3 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div x-data="{ show: true }" 
                             x-show="show" 
                             x-init="setTimeout(() => show = false, 3000)"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="mb-6 bg-status-review/10 border border-status-review text-status-review px-4 py-3 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>