<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('concepts.show', $concept) }}" 
               class="text-dark-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-bold text-3xl text-white">Edit Concept</h2>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-0">
        <div class="bg-dark-800 rounded-lg p-8 border border-dark-700">
            <form method="POST" action="{{ route('concepts.update', $concept) }}">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-white mb-2">
                        Concept Title <span class="text-status-review">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $concept->title) }}"
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
                    <textarea 
                        name="explanation" 
                        id="explanation" 
                        rows="10"
                        class="w-full bg-dark-700 border-dark-600 text-white placeholder-dark-400 rounded-lg focus:ring-2 focus:ring-status-mastered focus:border-transparent transition resize-y"
                        required>{{ old('explanation', $concept->explanation) }}</textarea>
                    @error('explanation')
                        <p class="mt-2 text-sm text-status-review">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Difficulty Level -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-white mb-3">
                        Difficulty Level <span class="text-status-review">*</span>
                    </label>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" 
                                   name="difficulty" 
                                   value="junior" 
                                   class="peer sr-only" 
                                   {{ old('difficulty', $concept->difficulty) === 'junior' ? 'checked' : '' }}
                                   required>
                            <div class="p-4 bg-dark-700 border-2 border-dark-600 rounded-lg text-center transition
                                        peer-checked:border-difficulty-junior peer-checked:bg-difficulty-junior/10
                                        hover:border-dark-500">
                                <div class="text-2xl mb-2">🟢</div>
                                <div class="font-semibold text-white">Junior</div>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input type="radio" 
                                   name="difficulty" 
                                   value="mid" 
                                   class="peer sr-only"
                                   {{ old('difficulty', $concept->difficulty) === 'mid' ? 'checked' : '' }}>
                            <div class="p-4 bg-dark-700 border-2 border-dark-600 rounded-lg text-center transition
                                        peer-checked:border-difficulty-mid peer-checked:bg-difficulty-mid/10
                                        hover:border-dark-500">
                                <div class="text-2xl mb-2">🟡</div>
                                <div class="font-semibold text-white">Mid</div>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input type="radio" 
                                   name="difficulty" 
                                   value="senior" 
                                   class="peer sr-only"
                                   {{ old('difficulty', $concept->difficulty) === 'senior' ? 'checked' : '' }}>
                            <div class="p-4 bg-dark-700 border-2 border-dark-600 rounded-lg text-center transition
                                        peer-checked:border-difficulty-senior peer-checked:bg-difficulty-senior/10
                                        hover:border-dark-500">
                                <div class="text-2xl mb-2">🔴</div>
                                <div class="font-semibold text-white">Senior</div>
                            </div>
                        </label>
                    </div>
                    @error('difficulty')
                        <p class="mt-2 text-sm text-status-review">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-white mb-3">
                        Mastery Status <span class="text-status-review">*</span>
                    </label>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" 
                                   name="status" 
                                   value="to_review" 
                                   class="peer sr-only" 
                                   {{ old('status', $concept->status) === 'to_review' ? 'checked' : '' }}
                                   required>
                            <div class="p-4 bg-dark-700 border-2 border-dark-600 rounded-lg text-center transition
                                        peer-checked:border-status-review peer-checked:bg-status-review/10
                                        hover:border-dark-500">
                                <div class="font-semibold text-white">To Review</div>
                                <div class="text-xs text-dark-400 mt-1">Need to study</div>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input type="radio" 
                                   name="status" 
                                   value="in_progress" 
                                   class="peer sr-only"
                                   {{ old('status', $concept->status) === 'in_progress' ? 'checked' : '' }}>
                            <div class="p-4 bg-dark-700 border-2 border-dark-600 rounded-lg text-center transition
                                        peer-checked:border-status-progress peer-checked:bg-status-progress/10
                                        hover:border-dark-500">
                                <div class="font-semibold text-white">In Progress</div>
                                <div class="text-xs text-dark-400 mt-1">Learning</div>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input type="radio" 
                                   name="status" 
                                   value="mastered" 
                                   class="peer sr-only"
                                   {{ old('status', $concept->status) === 'mastered' ? 'checked' : '' }}>
                            <div class="p-4 bg-dark-700 border-2 border-dark-600 rounded-lg text-center transition
                                        peer-checked:border-status-mastered peer-checked:bg-status-mastered/10
                                        hover:border-dark-500">
                                <div class="font-semibold text-white">Mastered</div>
                                <div class="text-xs text-dark-400 mt-1">Confident</div>
                            </div>
                        </label>
                    </div>
                    @error('status')
                        <p class="mt-2 text-sm text-status-review">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-dark-700">
                    <a href="{{ route('concepts.show', $concept) }}" 
                       class="px-6 py-3 bg-dark-700 hover:bg-dark-600 text-white font-medium rounded-lg transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold rounded-lg transition inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Danger Zone -->
        <div class="mt-6 bg-status-review/10 border border-status-review rounded-lg p-6">
            <h3 class="font-semibold text-white mb-2 flex items-center">
                <svg class="w-5 h-5 mr-2 text-status-review" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                Archive Concept
            </h3>
            <p class="text-dark-300 text-sm mb-4">
                Archiving this concept will hide it from your list. You can restore it later from the archived concepts page.
            </p>
            <form method="POST" action="{{ route('concepts.destroy', $concept) }}" 
                  onsubmit="return confirm('Archive « {{ $concept->title }} »?\n\nYou can restore it later from the archived page.');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-6 py-3 bg-status-review hover:bg-status-review/80 text-white font-semibold rounded-lg transition">
                    Archive this concept
                </button>
            </form>
        </div>
    </div>
</x-app-layout>