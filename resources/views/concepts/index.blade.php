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
        <!-- Filters -->
        <div class="mb-6 flex flex-wrap gap-3">
            <!-- Filter by Status -->
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

            <!-- Filter by Difficulty (Bonus) -->
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
            <!-- Empty State -->
            <div class="bg-dark-800 rounded-lg p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-medium text-white">No concepts yet</h3>
                <p class="mt-2 text-dark-300">
                    @if(request('status') || request('difficulty'))
                        No concepts match your filters. Try adjusting your search.
                    @else
                        Start documenting your knowledge by creating your first concept.
                    @endif
                </p>
                <div class="mt-6">
                    @if(request('status') || request('difficulty'))
                        <a href="{{ route('concepts.index', $domain) }}" 
                           class="inline-flex items-center px-6 py-3 bg-dark-700 hover:bg-dark-600 text-white font-medium rounded-lg transition mr-3">
                            Clear filters
                        </a>
                    @endif
                    <a href="{{ route('concepts.create', $domain) }}" 
                       class="inline-flex items-center px-6 py-3 bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold rounded-lg transition">
                        Create first concept
                    </a>
                </div>
            </div>
        @else
            <!-- Concepts List -->
            <div class="space-y-4">
                @foreach ($concepts as $concept)
                    <div class="bg-dark-800 rounded-lg p-6 border-2 border-dark-700 hover:border-{{ $concept->status_color }}/50 transition group"
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
                            <!-- Left: Title and badges -->
                            <div class="flex-1">
                                <a href="{{ route('concepts.show', $concept) }}" 
                                   class="text-xl font-bold text-white hover:text-{{ $concept->status_color }} transition group-hover:text-{{ $concept->status_color }}">
                                    {{ $concept->title }}
                                </a>
                                
                                <div class="flex items-center space-x-2 mt-3">
                                    <!-- Difficulty Badge -->
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-{{ $concept->difficulty_color }}/20 text-{{ $concept->difficulty_color }}">
                                        {{ $concept->formatted_difficulty }}
                                    </span>
                                    
                                    <!-- Status Badge with Quick Change -->
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" 
                                                :disabled="updating"
                                                class="px-3 py-1 text-xs font-semibold rounded-full transition flex items-center space-x-1"
                                                :class="{
                                                    'bg-status-review/20 text-status-review': status === 'to_review',
                                                    'bg-status-progress/20 text-status-progress': status === 'in_progress',
                                                    'bg-status-mastered/20 text-status-mastered': status === 'mastered'
                                                }">
                                            <span x-text="status === 'to_review' ? 'To Review' : (status === 'in_progress' ? 'In Progress' : 'Mastered')"></span>
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>

                                        <!-- Dropdown -->
                                        <div x-show="open" 
                                             @click.away="open = false"
                                             x-transition
                                             class="absolute left-0 mt-2 w-40 rounded-md shadow-lg bg-dark-700 ring-1 ring-black ring-opacity-5 z-10"
                                             style="display: none;">
                                            <div class="py-1">
                                                <button @click="changeStatus('to_review'); open = false" 
                                                        class="block w-full text-left px-4 py-2 text-sm text-status-review hover:bg-dark-600">
                                                    To Review
                                                </button>
                                                <button @click="changeStatus('in_progress'); open = false" 
                                                        class="block w-full text-left px-4 py-2 text-sm text-status-progress hover:bg-dark-600">
                                                    In Progress
                                                </button>
                                                <button @click="changeStatus('mastered'); open = false" 
                                                        class="block w-full text-left px-4 py-2 text-sm text-status-mastered hover:bg-dark-600">
                                                    Mastered
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Loading indicator -->
                                    <span x-show="updating" class="text-xs text-dark-400">
                                        Updating...
                                    </span>
                                </div>

                                <!-- Excerpt -->
                                <p class="mt-3 text-dark-300 text-sm line-clamp-2">
                                    {{ Str::limit($concept->explanation, 150) }}
                                </p>
                            </div>

                            <!-- Right: Actions -->
                            <div class="ml-6 flex items-center space-x-2">
                                <a href="{{ route('concepts.show', $concept) }}" 
                                   class="p-2 text-dark-400 hover:text-status-mastered transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('concepts.edit', $concept) }}" 
                                   class="p-2 text-dark-400 hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('concepts.destroy', $concept) }}" 
                                      onsubmit="return confirm('Archive this concept? You can restore it later.');">
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
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
