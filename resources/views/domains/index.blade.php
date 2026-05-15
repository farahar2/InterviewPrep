<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white">
                My Technical Domains
            </h2>
            <a href="{{ route('domains.create') }}"
               class="bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 ease-in-out hover:scale-[1.02] active:scale-[0.98] inline-flex items-center shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Domain
            </a>
        </div>
    </x-slot>

    <div class="px-4 sm:px-0">
        @if ($domains->isEmpty())
            <div class="bg-white dark:bg-dark-800 rounded-xl p-12 text-center border border-gray-200 dark:border-dark-700 shadow-sm">
                <svg class="mx-auto h-16 w-16 text-gray-300 dark:text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-medium text-gray-900 dark:text-white">No domains yet</h3>
                <p class="mt-2 text-gray-500 dark:text-dark-300">Start by creating your first technical domain.</p>
                <div class="mt-6">
                    <a href="{{ route('domains.create') }}"
                       class="inline-flex items-center px-6 py-3 bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold rounded-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] shadow-sm">
                        Create my first domain
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                @foreach ($domains as $domain)
                    <div class="bg-white dark:bg-dark-800 rounded-xl p-6 border border-gray-200 dark:border-dark-700 shadow-sm hover:shadow-md transition-all duration-300 ease-in-out hover:-translate-y-1 group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-4 h-4 rounded-full ring-2 ring-offset-2 ring-offset-white dark:ring-offset-dark-800" style="background-color: {{ $domain->color }}"></div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-status-mastered transition-colors duration-200">
                                    {{ $domain->name }}
                                </h3>
                            </div>

                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="text-gray-400 dark:text-dark-400 hover:text-gray-600 dark:hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
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
                                     class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-dark-700 ring-1 ring-black ring-opacity-5 z-10"
                                     style="display: none;">
                                    <div class="py-1">
                                        <a href="{{ route('domains.edit', $domain) }}"
                                           class="block px-4 py-2 text-sm text-gray-700 dark:text-dark-300 hover:bg-gray-100 dark:hover:bg-dark-600 hover:text-gray-900 dark:hover:text-white">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('domains.destroy', $domain) }}"
                                              onsubmit="return confirm('Are you sure you want to delete this domain?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="block w-full text-left px-4 py-2 text-sm text-status-review hover:bg-gray-100 dark:hover:bg-dark-600">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="flex items-center justify-between text-sm mb-2">
                                <span class="text-gray-500 dark:text-dark-400">Progress</span>
                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ $domain->mastered_concepts_count ?? 0 }} / {{ $domain->total_concepts_count ?? 0 }} concepts
                                </span>
                            </div>

                            <div class="w-full bg-gray-100 dark:bg-dark-700 rounded-full h-2 overflow-hidden">
                                <div class="bg-status-mastered h-2 rounded-full transition-all duration-500 ease-out"
                                     style="width: {{ $domain->progress_percentage ?? 0 }}%"></div>
                            </div>

                            <div class="mt-2 text-right">
                                <span class="text-xs font-semibold text-status-mastered">
                                    {{ $domain->progress_percentage ?? 0 }}%
                                </span>
                            </div>
                        </div>

                        <a href="{{ route('concepts.index', $domain) }}"
                           class="block w-full text-center bg-gray-100 dark:bg-dark-700 hover:bg-gray-200 dark:hover:bg-dark-600 text-gray-700 dark:text-white font-medium py-2.5 rounded-lg transition-all duration-200 hover:scale-[1.01] active:scale-[0.99]">
                            View concepts ({{ $domain->total_concepts_count ?? 0 }})
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>