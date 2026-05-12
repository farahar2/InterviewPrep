<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-white">
                My Technical Domains
            </h2>
            <a href="{{ route('domains.create') }}" 
               class="bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold px-6 py-3 rounded-lg transition duration-150 ease-in-out inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Domain
            </a>
        </div>
    </x-slot>

    <div class="px-4 sm:px-0">
        @if ($domains->isEmpty())
            <!-- État vide -->
            <div class="bg-dark-800 rounded-lg p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-medium text-white">No domains yet</h3>
                <p class="mt-2 text-dark-300">Start by creating your first technical domain.</p>
                <div class="mt-6">
                    <a href="{{ route('domains.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold rounded-lg transition">
                        Create my first domain
                    </a>
                </div>
            </div>
        @else
            <!-- Grille de cartes -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($domains as $domain)
                    <div class="bg-dark-800 rounded-lg p-6 border-2 border-dark-700 hover:border-status-mastered/50 transition duration-200 group">
                        <!-- Header avec couleur du domaine -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-4 h-4 rounded-full" style="background-color: {{ $domain->color }}"></div>
                                <h3 class="text-xl font-bold text-white group-hover:text-status-mastered transition">
                                    {{ $domain->name }}
                                </h3>
                            </div>
                            
                            <!-- Menu actions -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="text-dark-400 hover:text-white">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                    </svg>
                                </button>

                                <div x-show="open" 
                                     @click.away="open = false"
                                     x-transition
                                     class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-dark-700 ring-1 ring-black ring-opacity-5 z-10"
                                     style="display: none;">
                                    <div class="py-1">
                                        <a href="{{ route('domains.edit', $domain) }}" 
                                           class="block px-4 py-2 text-sm text-dark-300 hover:bg-dark-600 hover:text-white">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('domains.destroy', $domain) }}" 
                                              onsubmit="return confirm('Are you sure you want to delete this domain?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="block w-full text-left px-4 py-2 text-sm text-status-review hover:bg-dark-600">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistiques -->
                        <div class="mb-4">
                            <div class="flex items-center justify-between text-sm mb-2">
                                <span class="text-dark-300">Progress</span>
                                <span class="font-semibold text-white">
                                    {{ $domain->mastered_concepts_count }} / {{ $domain->total_concepts_count }} concepts
                                </span>
                            </div>
                            
                            <!-- Barre de progression -->
                            <div class="w-full bg-dark-700 rounded-full h-2">
                                <div class="bg-status-mastered h-2 rounded-full transition-all duration-300" 
                                     style="width: {{ $domain->progress_percentage }}%"></div>
                            </div>
                            
                            <div class="mt-2 text-right">
                                <span class="text-xs font-semibold text-status-mastered">
                                    {{ $domain->progress_percentage }}%
                                </span>
                            </div>
                        </div>

                        <!-- Bouton voir concepts -->
                        <a href="#" 
                           class="block w-full text-center bg-dark-700 hover:bg-dark-600 text-white font-medium py-2 rounded-lg transition">
                            View Concepts
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>