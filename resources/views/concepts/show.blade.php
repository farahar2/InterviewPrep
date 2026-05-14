<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('concepts.index', $concept->domain) }}" 
                   class="text-dark-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="font-bold text-3xl text-white">{{ $concept->title }}</h2>
                    <div class="flex items-center space-x-3 mt-2">
                        <a href="{{ route('domains.index') }}" class="text-dark-400 hover:text-white text-sm transition">
                            Domains
                        </a>
                        <span class="text-dark-600">/</span>
                        <a href="{{ route('concepts.index', $concept->domain) }}" 
                           class="flex items-center space-x-2 text-dark-400 hover:text-white text-sm transition">
                            <div class="w-3 h-3 rounded-full" style="background-color: {{ $concept->domain->color }}"></div>
                            <span>{{ $concept->domain->name }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <a href="{{ route('concepts.edit', $concept) }}" 
               class="bg-dark-700 hover:bg-dark-600 text-white font-semibold px-6 py-3 rounded-lg transition inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Concept
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-0">
        <!-- Concept Details Card -->
        <div class="bg-dark-800 rounded-lg p-8 border border-dark-700 mb-6">
            <!-- Badges -->
            <div class="flex items-center space-x-3 mb-6">
                <span class="px-4 py-2 text-sm font-semibold rounded-full bg-{{ $concept->difficulty_color }}/20 text-{{ $concept->difficulty_color }}">
                    {{ $concept->formatted_difficulty }}
                </span>
                <span class="px-4 py-2 text-sm font-semibold rounded-full bg-{{ $concept->status_color }}/20 text-{{ $concept->status_color }}">
                    {{ $concept->formatted_status }}
                </span>
                <span class="text-sm text-dark-400">
                    Created {{ $concept->created_at->diffForHumans() }}
                </span>
            </div>

            <!-- Explanation -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-status-mastered" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    My Explanation
                </h3>
                <div class="prose prose-invert max-w-none">
                    <p class="text-dark-200 whitespace-pre-line leading-relaxed">{{ $concept->explanation }}</p>
                </div>
            </div>
        </div>

        <!-- AI Generated Questions Section -->
<div class="bg-dark-800 rounded-lg p-8 border border-dark-700">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-white flex items-center">
            <svg class="w-6 h-6 mr-2 text-status-mastered" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
            Interview Questions
            @if($concept->generations->count() > 0)
                <span class="ml-2 px-2 py-1 text-xs font-semibold bg-status-mastered/20 text-status-mastered rounded-full">
                    {{ $concept->generations->count() }} set(s)
                </span>
            @endif
        </h3>
        
        <!-- Generate Button with Loading State -->
        <form method="POST" 
              action="{{ route('generations.store', $concept) }}"
              x-data="{ generating: false }"
              @submit="generating = true">
            @csrf
            <button type="submit"
                    :disabled="generating"
                    class="bg-status-mastered hover:bg-status-mastered/80 disabled:bg-dark-600 disabled:cursor-not-allowed text-white font-semibold px-6 py-3 rounded-lg transition inline-flex items-center">
                <svg x-show="!generating" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <svg x-show="generating" class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span x-text="generating ? 'Generating...' : 'Generate Questions'"></span>
            </button>
        </form>
    </div>

    @if($concept->generations->isEmpty())
        <!-- Empty state -->
        <div class="text-center py-12 border-2 border-dashed border-dark-700 rounded-lg">
            <svg class="mx-auto h-12 w-12 text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h4 class="mt-4 text-lg font-medium text-white">No questions generated yet</h4>
            <p class="mt-2 text-dark-400">
                Click "Generate Questions" to create interview questions based on this concept using AI.
            </p>
            <p class="mt-1 text-xs text-dark-500">
                Powered by Groq AI • llama3-8b-8192
            </p>
        </div>
    @else
        <!-- Generations List -->
        <div class="space-y-6">
            @foreach($concept->generations->sortByDesc('created_at') as $generation)
                <div class="bg-dark-700/50 rounded-lg p-6 border border-dark-600">
                    <!-- Generation Header -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-status-mastered/20 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-status-mastered" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-white">Generation Set</p>
                                <p class="text-xs text-dark-400">{{ $generation->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        
                        <!-- Delete Button -->
                        <form method="POST" 
                              action="{{ route('generations.destroy', $generation) }}"
                              onsubmit="return confirm('Delete this question set?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="p-2 text-dark-400 hover:text-status-review transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Questions List -->
                    <div class="space-y-3">
                        @foreach($generation->questions as $index => $question)
                            <div class="flex items-start space-x-3 group">
                                <div class="flex-shrink-0 w-6 h-6 bg-dark-600 rounded-full flex items-center justify-center text-xs font-semibold text-status-mastered">
                                    {{ $index + 1 }}
                                </div>
                                <p class="flex-1 text-dark-200 text-sm leading-relaxed group-hover:text-white transition">
                                    {{ $question }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Info Footer -->
        <div class="mt-4 text-center">
            <p class="text-xs text-dark-500">
                💡 Tip: Generate multiple sets to get different question variations
            </p>
        </div>
    @endif
</div>