<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{
          theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
          toggleTheme() {
              this.theme = this.theme === 'dark' ? 'light' : 'dark'
          }
      }"
      x-init="$watch('theme', val => {
          localStorage.setItem('theme', val)
          document.documentElement.classList.toggle('dark', val === 'dark')
      })"
      :class="theme">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-dark-900 text-gray-900 dark:text-white transition-colors duration-300">
        <div class="min-h-screen">
            <nav class="bg-white dark:bg-dark-800 border-b border-gray-200 dark:border-dark-700 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-gray-900 dark:text-white">
                                    Interview<span class="text-status-mastered">Prep</span>
                                </a>
                            </div>

                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <a href="{{ route('dashboard') }}"
                                   class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out
                                   {{ request()->routeIs('dashboard') ? 'border-status-mastered text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-dark-300 hover:text-gray-700 dark:hover:text-white hover:border-gray-300 dark:hover:border-dark-500' }}">
                                    Dashboard
                                </a>
                                <a href="{{ route('domains.index') }}"
                                   class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out
                                   {{ request()->routeIs('domains.*') || request()->routeIs('concepts.*') ? 'border-status-mastered text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-dark-300 hover:text-gray-700 dark:hover:text-white hover:border-gray-300 dark:hover:border-dark-500' }}">
                                    Technical Domains
                                </a>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-3">
                            <button @click="toggleTheme()"
                                    class="p-2 rounded-lg text-gray-500 dark:text-dark-300 hover:bg-gray-100 dark:hover:bg-dark-700 hover:text-gray-700 dark:hover:text-white transition-colors duration-200"
                                    :title="theme === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                                <svg x-show="theme === 'dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <svg x-show="theme === 'light'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                </svg>
                            </button>

                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                        class="flex items-center text-sm font-medium text-gray-500 dark:text-dark-300 hover:text-gray-700 dark:hover:text-white focus:outline-none transition duration-150 ease-in-out">
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
                                     class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-dark-700 ring-1 ring-black ring-opacity-5 z-50"
                                     style="display: none;">
                                    <div class="py-1">
                                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-dark-300 hover:bg-gray-100 dark:hover:bg-dark-600 hover:text-gray-900 dark:hover:text-white">
                                            Profile
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-dark-300 hover:bg-gray-100 dark:hover:bg-dark-600 hover:text-gray-900 dark:hover:text-white">
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

            @if (isset($header))
                <header class="bg-white dark:bg-dark-800 border-b border-gray-200 dark:border-dark-700 shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="py-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

        <script>
            if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        </script>
    </body>
</html>