<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('concepts.index', $domain) }}" 
                   class="text-dark-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 rounded-full" style="background-color: {{ $domain->color }}"></div>
                        <h2 class="font-bold text-3xl text-white">Archived Concepts</h2>
                    </div>
                    <p class="text-dark-400 text-sm mt-1">
                        {{ $domain->name }} &mdash; {{ $concepts->count() }} archived concepts
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-0">
        @if ($concepts->isEmpty())
            <div class="bg-dark-800 rounded-lg p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                <h3 class="mt-4 text-xl font-medium text-white">No archived concepts</h3>
                <p class="mt-2 text-dark-300">Deleted concepts will appear here so you can restore them.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($concepts as $concept)
                    <div class="bg-dark-800 rounded-lg p-5 border border-dark-700 flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-3">
                                <h3 class="text-lg font-semibold text-white truncate">
                                    {{ $concept->title }}
                                </h3>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $concept->difficulty_color === 'difficulty-junior' ? 'bg-difficulty-junior/10 text-difficulty-junior' : '' }}
                                    {{ $concept->difficulty_color === 'difficulty-mid' ? 'bg-difficulty-mid/10 text-difficulty-mid' : '' }}
                                    {{ $concept->difficulty_color === 'difficulty-senior' ? 'bg-difficulty-senior/10 text-difficulty-senior' : '' }}">
                                    {{ $concept->formatted_difficulty }}
                                </span>
                            </div>
                            <p class="text-dark-400 text-sm mt-1 truncate">
                                {{ $concept->explanation }}
                            </p>
                            <p class="text-dark-500 text-xs mt-1">
                                Archived {{ $concept->deleted_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="ml-4 shrink-0">
                            <form method="POST" action="{{ route('concepts.restore', $concept->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="bg-dark-700 hover:bg-status-mastered/20 text-white font-medium px-5 py-2.5 rounded-lg transition inline-flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Restore
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
