<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('domains.index') }}"
                   class="text-gray-400 dark:text-dark-400 hover:text-gray-600 dark:hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 rounded-full ring-2 ring-offset-2 ring-offset-white dark:ring-offset-dark-800" style="background-color: {{ $domain->color }}"></div>
                        <h2 class="font-bold text-3xl text-gray-900 dark:text-white">{{ $domain->name }}</h2>
                    </div>
                    <p class="text-gray-500 dark:text-dark-400 text-sm mt-1">
                        {{ $domain->mastered_concepts_count ?? 0 }} / {{ $domain->total_concepts_count ?? 0 }} concepts mastered
                    </p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('concepts.archived', $domain) }}"
                   class="text-gray-500 dark:text-dark-400 hover:text-gray-700 dark:hover:text-white transition-all duration-200 inline-flex items-center text-sm px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-dark-700">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Archived
                </a>
                <a href="{{ route('concepts.create', $domain) }}"
                   class="bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] inline-flex items-center shadow-sm">
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
                <span class="text-sm font-medium text-gray-500 dark:text-dark-400">Status:</span>
                <a href="{{ route('concepts.index', $domain) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                   {{ !request('status') ? 'bg-gray-900 dark:bg-white text-white dark:text-gray-900 shadow-sm' : 'bg-gray-100 dark:bg-dark-700 text-gray-600 dark:text-dark-300 hover:bg-gray-200 dark:hover:bg-dark-600' }}">
                    All
                </a>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => 'to_review']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                   {{ request('status') === 'to_review' ? 'bg-status-review text-white shadow-sm' : 'bg-gray-100 dark:bg-dark-700 text-gray-600 dark:text-dark-300 hover:bg-gray-200 dark:hover:bg-dark-600' }}">
                    To Review
                </a>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => 'in_progress']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                   {{ request('status') === 'in_progress' ? 'bg-status-progress text-white shadow-sm' : 'bg-gray-100 dark:bg-dark-700 text-gray-600 dark:text-dark-300 hover:bg-gray-200 dark:hover:bg-dark-600' }}">
                    In Progress
                </a>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => 'mastered']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                   {{ request('status') === 'mastered' ? 'bg-status-mastered text-white shadow-sm' : 'bg-gray-100 dark:bg-dark-700 text-gray-600 dark:text-dark-300 hover:bg-gray-200 dark:hover:bg-dark-600' }}">
                    Mastered
                </a>
            </div>

            <div class="flex items-center space-x-2 border-l border-gray-200 dark:border-dark-700 pl-3">
                <span class="text-sm font-medium text-gray-500 dark:text-dark-400">Difficulty:</span>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => request('status')]) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                   {{ !request('difficulty') ? 'bg-gray-900 dark:bg-white text-white dark:text-gray-900 shadow-sm' : 'bg-gray-100 dark:bg-dark-700 text-gray-600 dark:text-dark-300 hover:bg-gray-200 dark:hover:bg-dark-600' }}">
                    All
                </a>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => request('status'), 'difficulty' => 'junior']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                   {{ request('difficulty') === 'junior' ? 'bg-difficulty-junior text-white shadow-sm' : 'bg-gray-100 dark:bg-dark-700 text-gray-600 dark:text-dark-300 hover:bg-gray-200 dark:hover:bg-dark-600' }}">
                    Junior
                </a>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => request('status'), 'difficulty' => 'mid']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                   {{ request('difficulty') === 'mid' ? 'bg-difficulty-mid text-white shadow-sm' : 'bg-gray-100 dark:bg-dark-700 text-gray-600 dark:text-dark-300 hover:bg-gray-200 dark:hover:bg-dark-600' }}">
                    Mid
                </a>
                <a href="{{ route('concepts.index', ['domain' => $domain, 'status' => request('status'), 'difficulty' => 'senior']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                   {{ request('difficulty') === 'senior' ? 'bg-difficulty-senior text-white shadow-sm' : 'bg-gray-100 dark:bg-dark-700 text-gray-600 dark:text-dark-300 hover:bg-gray-200 dark:hover:bg-dark-600' }}">
                    Senior
                </a>
            </div>
        </div>

        @if ($concepts->isEmpty())
            <div class="bg-white dark:bg-dark-800 rounded-xl p-12 text-center border border-gray-200 dark:border-dark-700 shadow-sm">
                <svg class="mx-auto h-16 w-16 text-gray-300 dark:text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-medium text-gray-900 dark:text-white">No concepts yet</h3>
                <p class="mt-2 text-gray-500 dark:text-dark-300">
                    @if(request('status') || request('difficulty'))
                        No concepts match your filters. Try adjusting your search.
                    @else
                        Start documenting your knowledge by creating your first concept.
                    @endif
                </p>
                <div class="mt-6">
                    @if(request('status') || request('difficulty'))
                        <a href="{{ route('concepts.index', $domain) }}"
                           class="inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-dark-700 hover:bg-gray-200 dark:hover:bg-dark-600 text-gray-700 dark:text-white font-medium rounded-lg transition-all duration-200 mr-3">
                            Clear filters
                        </a>
                    @endif
                    <a href="{{ route('concepts.create', $domain) }}"
                       class="inline-flex items-center px-6 py-3 bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold rounded-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] shadow-sm">
                        Create first concept
                    </a>
                </div>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($concepts as $concept)
                    <div class="bg-white dark:bg-dark-800 rounded-xl p-6 border border-gray-200 dark:border-dark-700 hover:border-gray-300 dark:hover:border-dark-500 transition-all duration-300 ease-in-out hover:shadow-md hover:-translate-y-0.5 group"
                         x-data="{
                             status: '{{ $concept->status }}',
                             updating: false,
                             async changeStatus(newStatus) {
                                 this.updating = true;
                                 try {
                                     const response = await fetch('{{ route('concepts.update-status', $concept) }}', {
                                         method: 'PATCH',
                                         headers: {
                                             'Content-Type': 'application/json',
                                             'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                         },
                                         body: JSON.stringify({ status: newStatus })
                                     });
                                     const data = await response.json();
                                     if (data.success) {
                                         this.status = data.status;
                                     }
                                 } catch (error) {
                                     console.error('Error:', error);
                                 } finally {
                                     this.updating = false;
                                 }
                             }
                         }">

                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <a href="{{ route('concepts.show', $concept) }}"
                                   class="text-xl font-bold text-gray-900 dark:text-white hover:text-status-mastered transition-colors duration-200">
                                    {{ $concept->title }}
                                </a>

                                <div class="flex items-center space-x-2 mt-3">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full"
                                          :class="{
                                              'bg-difficulty-junior/10 text-difficulty-junior': '{{ $concept->difficulty }}' === 'junior',
                                              'bg-difficulty-mid/10 text-difficulty-mid': '{{ $concept->difficulty }}' === 'mid',
                                              'bg-difficulty-senior/10 text-difficulty-senior': '{{ $concept->difficulty }}' === 'senior'
                                          }">
                                        {{ $concept->formatted_difficulty }}
                                    </span>

                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open"
                                                :disabled="updating"
                                                class="px-3 py-1 text-xs font-semibold rounded-full transition-all duration-200 flex items-center space-x-1"
                                                :class="{
                                                    'bg-status-review/10 text-status-review': status === 'to_review',
                                                    'bg-status-progress/10 text-status-progress': status === 'in_progress',
                                                    'bg-status-mastered/10 text-status-mastered': status === 'mastered'
                                                }">
                                            <span x-text="status === 'to_review' ? 'To Review' : (status === 'in_progress' ? 'In Progress' : 'Mastered')"></span>
                                            <svg class="w-3 h-3 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
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
                                             class="absolute left-0 mt-2 w-40 rounded-lg shadow-lg bg-white dark:bg-dark-700 ring-1 ring-black ring-opacity-5 z-10 border border-gray-100 dark:border-dark-600"
                                             style="display: none;">
                                            <div class="py-1">
                                                <button @click="changeStatus('to_review'); open = false"
                                                        class="block w-full text-left px-4 py-2.5 text-sm text-status-review hover:bg-gray-50 dark:hover:bg-dark-600 transition-colors">
                                                    To Review
                                                </button>
                                                <button @click="changeStatus('in_progress'); open = false"
                                                        class="block w-full text-left px-4 py-2.5 text-sm text-status-progress hover:bg-gray-50 dark:hover:bg-dark-600 transition-colors">
                                                    In Progress
                                                </button>
                                                <button @click="changeStatus('mastered'); open = false"
                                                        class="block w-full text-left px-4 py-2.5 text-sm text-status-mastered hover:bg-gray-50 dark:hover:bg-dark-600 transition-colors">
                                                    Mastered
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <span x-show="updating" class="text-xs text-gray-400 dark:text-dark-400 animate-pulse">
                                        Updating...
                                    </span>
                                </div>

                                <p class="mt-3 text-gray-500 dark:text-dark-300 text-sm line-clamp-2">
                                    {{ Str::limit($concept->explanation, 150) }}
                                </p>
                            </div>

                            <div class="ml-6 flex items-center space-x-2">
                                <a href="{{ route('concepts.show', $concept) }}"
                                   class="p-2 text-gray-400 dark:text-dark-400 hover:text-status-mastered transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-dark-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('concepts.edit', $concept) }}"
                                   class="p-2 text-gray-400 dark:text-dark-400 hover:text-gray-600 dark:hover:text-white transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-dark-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('concepts.destroy', $concept) }}"
                                      onsubmit="return confirm('Archive this concept? You can restore it later.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 text-gray-400 dark:text-dark-400 hover:text-status-review transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-dark-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>