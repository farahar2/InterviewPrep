<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('domains.index') }}" 
                   class="text-dark-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 rounded-full" style="background-color: {{ $domain->color }}"></div>
                        <h2 class="font-bold text-3xl text-white">{{ $domain->name }}</h2>
                    </div>
                    <p class="text-dark-400 text-sm mt-1">
                        {{ $domain->mastered_concepts_count }} / {{ $domain->total_concepts_count }} concepts mastered
                    </p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('concepts.archived', $domain) }}" 
                   class="text-dark-400 hover:text-white transition inline-flex items-center text-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Archived
                </a>
                <a href="{{ route('concepts.create', $domain) }}" 
                   class="bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold px-6 py-3 rounded-lg transition inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Concept
                </a>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-0">
        <div class="mb-6 flex flex-wrap gap-3">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-dark-400 font-medium">Status:</span>
                <a href="{{ route('concepts.index', $domain) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition
                   {{ !request('status') ? 'bg-dark-700 text-white' : 'bg-dark-800 text-dark-400 hover:text-white' }}">
                    All
                </a>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => 'to_review']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition
                   {{ request('status') === 'to_review' ? 'bg-status-review text-white' : 'bg-dark-800 text-dark-400 hover:text-white' }}">
                    To Review
                </a>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => 'in_progress']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition
                   {{ request('status') === 'in_progress' ? 'bg-status-progress text-white' : 'bg-dark-800 text-dark-400 hover:text-white' }}">
                    In Progress
                </a>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => 'mastered']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition
                   {{ request('status') === 'mastered' ? 'bg-status-mastered text-white' : 'bg-dark-800 text-dark-400 hover:text-white' }}">
                    Mastered
                </a>
            </div>

            <div class="flex items-center space-x-2 border-l border-dark-700 pl-3">
                <span class="text-sm text-dark-400 font-medium">Difficulty:</span>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => request('status')]) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition
                   {{ !request('difficulty') ? 'bg-dark-700 text-white' : 'bg-dark-800 text-dark-400 hover:text-white' }}">
                    All
                </a>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => request('status'), 'difficulty' => 'junior']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition
                   {{ request('difficulty') === 'junior' ? 'bg-difficulty-junior text-white' : 'bg-dark-800 text-dark-400 hover:text-white' }}">
                    Junior
                </a>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => request('status'), 'difficulty' => 'mid']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition
                   {{ request('difficulty') === 'mid' ? 'bg-difficulty-mid text-white' : 'bg-dark-800 text-dark-400 hover:text-white' }}">
                    Mid
                </a>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => request('status'), 'difficulty' => 'senior']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition
                   {{ request('difficulty') === 'senior' ? 'bg-difficulty-senior text-white' : 'bg-dark-800 text-dark-400 hover:text-white' }}">
                    Senior
                </a>
            </div>
        </div>

        @if ($concepts->isEmpty())
            <div class="bg-dark-800 rounded-lg p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-medium text-white">No concepts yet</h3>
                <p class="mt-2 text-dark-300">Start by creating your first concept for this domain.</p>
                <div class="mt-6">
                    <a href="{{ route('concepts.create', $domain) }}" 
                       class="inline-flex items-center px-6 py-3 bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold rounded-lg transition">
                        Create my first concept
                    </a>
                </div>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($concepts as $concept)
                    <div class="bg-dark-800 rounded-lg p-5 border border-dark-700">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-lg font-semibold text-white">
                                        {{ $concept->title }}
                                    </h3>
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $concept->difficulty_color === 'difficulty-junior' ? 'bg-difficulty-junior/10 text-difficulty-junior' : '' }}
                                        {{ $concept->difficulty_color === 'difficulty-mid' ? 'bg-difficulty-mid/10 text-difficulty-mid' : '' }}
                                        {{ $concept->difficulty_color === 'difficulty-senior' ? 'bg-difficulty-senior/10 text-difficulty-senior' : '' }}">
                                        {{ $concept->formatted_difficulty }}
                                    </span>
                                </div>
                                <p class="text-dark-400 text-sm mt-2 line-clamp-2">
                                    {{ $concept->explanation }}
                                </p>
                            </div>

                            <form method="POST" action="{{ route('concepts.destroy', $concept) }}"
                                  onsubmit="return confirm('Archive this concept? You can restore it later.');"
                                  class="ml-4 shrink-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-dark-400 hover:text-status-review transition p-1" title="Archive">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
