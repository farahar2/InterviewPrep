<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('concepts.index', $domain) }}" 
               class="text-dark-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-3xl text-white">Create New Concept</h2>
                <div class="flex items-center space-x-2 mt-1">
                    <div class="w-3 h-3 rounded-full" style="background-color: {{ $domain->color }}"></div>
                    <span class="text-dark-400 text-sm">in {{ $domain->name }}</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-0">
        <div class="bg-dark-800 rounded-lg p-8 border border-dark-700">
            <form method="POST" action="{{ route('concepts.store', $domain) }}">
                @csrf

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-white mb-2">
                        Concept Title <span class="text-status-review">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}"
                           placeholder="E.g: Eloquent N+1 Problem, Dependency Injection, RESTful APIs..."
                           class="w-full bg-dark-700 border-dark-600 text-white placeholder-dark-400 rounded-lg focus:ring-2 focus:ring-status-mastered focus:border-transparent transition"
                           required
                           autofocus>
                    @error('title')
                        <p class="mt-2 text-sm text-status-review">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Explanation -->
                <div class="mb-6">
                    <label for="explanation" class="block text-sm font-semibold text-white mb-2">
                        Your Explanation <span class="text-status-review">*</span>
                    </label>
                    <p class="text-xs text-dark-400 mb-2">
                        Explain this concept in your own words. What is it? How does it work? Why is it important?
                    </p>
                    <textarea 
                        name="explanation" 
                        id="explanation" 
                        rows="10"
                        placeholder="Write your explanation here...&#10;&#10;You can use multiple paragraphs.&#10;&#10;Tip: Include examples, use cases, or code snippets to make it more memorable."
                        class="w-full bg-dark-700 border-dark-600 text-white placeholder-dark-400 rounded-lg focus:ring-2 focus:ring-status-mastered focus:border-transparent transition resize-y"
                        required>{{ old('explanation') }}</textarea>
                    @error('explanation')
                        <p class="mt-2 text-sm text-status-review">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Difficulty Level -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-white mb-3">
                        Difficulty Level <span class="text-status-review">*</span>
                    </label>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" 
                                   name="difficulty" 
                                   value="junior" 
                                   class="peer sr-only" 
                                   {{ old('difficulty') === 'junior' ? 'checked' : '' }}
                                   required>
                            <div class="p-4 bg-dark-700 border-2 border-dark-600 rounded-lg text-center transition
                                        peer-checked:border-difficulty-junior peer-checked:bg-difficulty-junior/10
                                        hover:border-dark-500">
                                <div class="text-2xl mb-2">🟢</div>
                                <div class="font-semibold text-white">Junior</div>
                                <div class="text-xs text-dark-400 mt-1">Entry level</div>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input type="radio" 
                                   name="difficulty" 
                                   value="mid" 
                                   class="peer sr-only"
                                   {{ old('difficulty') === 'mid' ? 'checked' : '' }}>
                            <div class="p-4 bg-dark-700 border-2 border-dark-600 rounded-lg text-center transition
                                        peer-checked:border-difficulty-mid peer-checked:bg-difficulty-mid/10
                                        hover:border-dark-500">
                                <div class="text-2xl mb-2">🟡</div>
                                <div class="font-semibold text-white">Mid</div>
                                <div class="text-xs text-dark-400 mt-1">Intermediate</div>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input type="radio" 
                                   name="difficulty" 
                                   value="senior" 
                                   class="peer sr-only"
                                   {{ old('difficulty') === 'senior' ? 'checked' : '' }}>
                            <div class="p-4 bg-dark-700 border-2 border-dark-600 rounded-lg text-center transition
                                        peer-checked:border-difficulty-senior peer-checked:bg-difficulty-senior/10
                                        hover:border-dark-500">
                                <div class="text-2xl mb-2">🔴</div>
                                <div class="font-semibold text-white">Senior</div>
                                <div class="text-xs text-dark-400 mt-1">Advanced</div>
                            </div>
                        </label>
                    </div>
                    @error('difficulty')
                        <p class="mt-2 text-sm text-status-review">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info box -->
                <div class="mb-6 bg-status-mastered/10 border border-status-mastered/30 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-status-mastered mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-status-mastered font-medium">Status will be set to "To Review"</p>
                            <p class="text-xs text-status-mastered/80 mt-1">
                                You can change the status later from the concept list or detail page.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-dark-700">
                    <a href="{{ route('concepts.index', $domain) }}" 
                       class="px-6 py-3 bg-dark-700 hover:bg-dark-600 text-white font-medium rounded-lg transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold rounded-lg transition inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Create Concept
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>