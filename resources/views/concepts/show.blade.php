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
                </h3>
                <button 
                    class="bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold px-6 py-3 rounded-lg transition inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Generate Questions
                </button>
            </div>

            <!-- Empty state for now (we'll add AI generation in Task 10) -->
            <div class="text-center py-12 border-2 border-dashed border-dark-700 rounded-lg">
                <svg class="mx-auto h-12 w-12 text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h4 class="mt-4 text-lg font-medium text-white">No questions generated yet</h4>
                <p class="mt-2 text-dark-400">
                    Click "Generate Questions" to create interview questions based on this concept using AI.
                </p>
            </div>

            <!-- Placeholder for future generations list -->
            <!-- We'll add this in Task 10 when we implement AI integration -->
        </div>
    </div>
</x-app-layout>