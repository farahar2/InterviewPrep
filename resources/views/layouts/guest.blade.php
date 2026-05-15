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
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-dark-900 text-gray-900 dark:text-white transition-colors duration-300">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div class="flex items-center justify-between w-full sm:max-w-md mb-4">
                <a href="/">
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">
                        Interview<span class="text-status-mastered">Prep</span>
                    </span>
                </a>
                <button @click="toggleTheme()"
                        class="p-2 rounded-lg text-gray-500 dark:text-dark-300 hover:bg-gray-200 dark:hover:bg-dark-700 transition-colors duration-200"
                        :title="theme === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                    <svg x-show="theme === 'dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg x-show="theme === 'light'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>
            </div>

            <div class="w-full sm:max-w-md bg-white dark:bg-dark-800 shadow-sm border border-gray-200 dark:border-dark-700 rounded-xl overflow-hidden">
                {{ $slot }}
            </div>
        </div>

        <script>
            if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        </script>
    </body>
</html>