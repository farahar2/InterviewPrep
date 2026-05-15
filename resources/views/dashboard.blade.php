<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 dark:text-white">
                    Welcome back, {{ Auth::user()->name }}
                </h2>
                <p class="text-gray-500 dark:text-dark-400 text-sm mt-1">
                    Here's your interview preparation progress overview.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-0 space-y-8 animate-fade-in">

        {{-- ============================================================== --}}
        {{-- EMPTY STATE: No domains created yet                              --}}
        {{-- ============================================================== --}}
        @if($totalConcepts === 0)
            <div class="bg-white dark:bg-dark-800 rounded-xl p-12 text-center border border-gray-200 dark:border-dark-700 shadow-sm">
                <svg class="mx-auto h-20 w-20 text-gray-300 dark:text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <h3 class="mt-6 text-2xl font-bold text-gray-900 dark:text-white">Get Started with InterviewPrep</h3>
                <p class="mt-3 text-gray-500 dark:text-dark-300 max-w-md mx-auto">
                    Create your first technical domain to start documenting concepts and generating AI-powered interview questions.
                </p>
                <div class="mt-8 flex items-center justify-center space-x-4">
                    <a href="{{ route('domains.create') }}"
                       class="inline-flex items-center px-8 py-4 bg-status-mastered hover:bg-status-mastered/80 text-white font-bold rounded-xl transition-all duration-200 hover:scale-[1.03] active:scale-[0.97] shadow-md text-lg">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Your First Domain
                    </a>
                </div>
            </div>
        @else

            {{-- ========================================================== --}}
            {{-- MASTERY PROGRESS BAR                                          --}}
            {{-- ========================================================== --}}
            <div class="bg-white dark:bg-dark-800 rounded-xl p-6 border border-gray-200 dark:border-dark-700 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-dark-200">Overall Mastery</h3>
                    <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $masteryPercentage }}%</span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-dark-700 rounded-full h-3 overflow-hidden">
                    <div class="bg-status-mastered h-3 rounded-full transition-all duration-1000 ease-out"
                         style="width: {{ $masteryPercentage }}%"></div>
                </div>
                <p class="text-xs text-gray-400 dark:text-dark-500 mt-2">
                    {{ $masteredCount }} of {{ $totalConcepts }} concepts mastered across your domains
                </p>
            </div>

            {{-- ========================================================== --}}
            {{-- KPI CARDS (4-wide grid)                                       --}}
            {{-- ========================================================== --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                {{-- Total Concepts --}}
                <div class="bg-white dark:bg-dark-800 rounded-xl p-5 border border-gray-200 dark:border-dark-700 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-dark-400">Total Concepts</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalConcepts }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-gray-100 dark:bg-dark-700 flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-500 dark:text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Mastered (Green) --}}
                <div class="bg-white dark:bg-dark-800 rounded-xl p-5 border border-gray-200 dark:border-dark-700 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-dark-400">Mastered</p>
                            <p class="text-3xl font-bold text-status-mastered mt-1">{{ $masteredCount }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-status-mastered/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-status-mastered" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- In Progress (Orange) --}}
                <div class="bg-white dark:bg-dark-800 rounded-xl p-5 border border-gray-200 dark:border-dark-700 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-dark-400">In Progress</p>
                            <p class="text-3xl font-bold text-status-progress mt-1">{{ $inProgressCount }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-status-progress/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-status-progress" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- To Review (Red) --}}
                <div class="bg-white dark:bg-dark-800 rounded-xl p-5 border border-gray-200 dark:border-dark-700 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-dark-400">To Review</p>
                            <p class="text-3xl font-bold text-status-review mt-1">{{ $toReviewCount }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-status-review/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-status-review" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================================== --}}
            {{-- MIDDLE SECTION: Strongest Domain + Focus Domain (2 cols)      --}}
            {{-- ========================================================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Strongest Domain --}}
                <div class="bg-white dark:bg-dark-800 rounded-xl p-6 border border-gray-200 dark:border-dark-700 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center space-x-3 mb-5">
                        <div class="w-10 h-10 rounded-xl bg-status-mastered/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-status-mastered" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Strongest Domain</h3>
                            <p class="text-xs text-gray-400 dark:text-dark-500">Most mastered concepts</p>
                        </div>
                    </div>

                    @if($strongestDomain)
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-4 h-4 rounded-full ring-2 ring-offset-2 ring-offset-white dark:ring-offset-dark-800" style="background-color: {{ $strongestDomain->color }}"></div>
                            <span class="font-semibold text-gray-900 dark:text-white text-lg">{{ $strongestDomain->name }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm mb-4">
                            <span class="text-gray-500 dark:text-dark-400">Mastered</span>
                            <span class="font-bold text-status-mastered">{{ $strongestDomain->mastered_count }} / {{ $strongestDomain->concepts()->count() }} concepts</span>
                        </div>
                        <div class="w-full bg-gray-100 dark:bg-dark-700 rounded-full h-2 mb-5">
                            <div class="bg-status-mastered h-2 rounded-full transition-all duration-500"
                                 style="width: {{ $strongestDomain->concepts()->count() > 0 ? round(($strongestDomain->mastered_count / $strongestDomain->concepts()->count()) * 100) : 0 }}%"></div>
                        </div>
                        <a href="{{ route('concepts.index', $strongestDomain) }}"
                           class="inline-flex items-center px-5 py-2.5 bg-gray-100 dark:bg-dark-700 hover:bg-gray-200 dark:hover:bg-dark-600 text-gray-700 dark:text-white font-medium rounded-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] text-sm">
                            View Concepts
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <p class="text-gray-400 dark:text-dark-500 text-sm italic">No mastered concepts yet.</p>
                    @endif
                </div>

                {{-- Focus Domain --}}
                <div class="bg-white dark:bg-dark-800 rounded-xl p-6 border border-gray-200 dark:border-dark-700 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center space-x-3 mb-5">
                        <div class="w-10 h-10 rounded-xl bg-status-review/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-status-review" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Priority Focus</h3>
                            <p class="text-xs text-gray-400 dark:text-dark-500">Most concepts to review</p>
                        </div>
                    </div>

                    @if($focusDomain)
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-4 h-4 rounded-full ring-2 ring-offset-2 ring-offset-white dark:ring-offset-dark-800" style="background-color: {{ $focusDomain->color }}"></div>
                            <span class="font-semibold text-gray-900 dark:text-white text-lg">{{ $focusDomain->name }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm mb-4">
                            <span class="text-gray-500 dark:text-dark-400">Needs Review</span>
                            <span class="font-bold text-status-review">{{ $focusDomain->review_count }} concepts</span>
                        </div>
                        <div class="w-full bg-gray-100 dark:bg-dark-700 rounded-full h-2 mb-5">
                            <div class="bg-status-review h-2 rounded-full transition-all duration-500"
                                 style="width: {{ $focusDomain->concepts()->count() > 0 ? round(($focusDomain->review_count / $focusDomain->concepts()->count()) * 100) : 0 }}%"></div>
                        </div>
                        <a href="{{ route('concepts.index', ['domain' => $focusDomain, 'status' => 'to_review']) }}"
                           class="inline-flex items-center px-5 py-2.5 bg-status-review hover:bg-status-review/80 text-white font-medium rounded-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] text-sm shadow-sm animate-pulse-slow">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Review Now
                        </a>
                    @else
                        <p class="text-gray-400 dark:text-dark-500 text-sm italic">No concepts to review!</p>
                    @endif
                </div>
            </div>

            {{-- ========================================================== --}}
            {{-- BOTTOM SECTION: Recently Updated Concepts (mini-table)        --}}
            {{-- ========================================================== --}}
            <div class="bg-white dark:bg-dark-800 rounded-xl border border-gray-200 dark:border-dark-700 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-dark-700 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-dark-700 flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-500 dark:text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Recently Updated</h3>
                    </div>
                    <span class="text-xs text-gray-400 dark:text-dark-500">{{ $recentConcepts->count() }} concepts</span>
                </div>

                @if($recentConcepts->isEmpty())
                    <div class="p-8 text-center">
                        <p class="text-gray-400 dark:text-dark-500 text-sm">No concepts yet. Create your first concept to get started.</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-100 dark:divide-dark-700">
                        @foreach($recentConcepts as $concept)
                            <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 dark:hover:bg-dark-700/50 transition-colors duration-150">
                                <div class="flex items-center space-x-4 min-w-0 flex-1">
                                    <div class="w-2 h-2 rounded-full shrink-0"
                                         :class="{
                                             'bg-status-review': '{{ $concept->status }}' === 'to_review',
                                             'bg-status-progress': '{{ $concept->status }}' === 'in_progress',
                                             'bg-status-mastered': '{{ $concept->status }}' === 'mastered'
                                         }"></div>
                                    <div class="min-w-0 flex-1">
                                        <a href="{{ route('concepts.show', $concept) }}"
                                           class="text-sm font-medium text-gray-900 dark:text-white hover:text-status-mastered transition-colors truncate block">
                                            {{ $concept->title }}
                                        </a>
                                        <div class="flex items-center space-x-2 mt-0.5">
                                            <span class="text-xs text-gray-400 dark:text-dark-500">{{ $concept->domain->name }}</span>
                                            <span class="text-gray-300 dark:text-dark-600">&middot;</span>
                                            <span class="text-xs text-gray-400 dark:text-dark-500">{{ $concept->updated_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-2 ml-4 shrink-0">
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full hidden sm:inline-block"
                                         :class="{
                                             'bg-difficulty-junior/10 text-difficulty-junior': '{{ $concept->difficulty }}' === 'junior',
                                             'bg-difficulty-mid/10 text-difficulty-mid': '{{ $concept->difficulty }}' === 'mid',
                                             'bg-difficulty-senior/10 text-difficulty-senior': '{{ $concept->difficulty }}' === 'senior'
                                         }">
                                        {{ $concept->formatted_difficulty }}
                                    </span>
                                    <a href="{{ route('concepts.show', $concept) }}"
                                       class="p-2 text-gray-400 dark:text-dark-400 hover:text-status-mastered transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-dark-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('concepts.show', $concept) }}#"
                                       class="p-2 text-gray-400 dark:text-dark-400 hover:text-status-progress transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-dark-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>