<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('domains.index') }}"
               class="text-gray-400 dark:text-dark-400 hover:text-gray-600 dark:hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white">
                Edit Domain
            </h2>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-0">
        <div class="bg-white dark:bg-dark-800 rounded-xl p-8 border border-gray-200 dark:border-dark-700 shadow-sm">
            <form method="POST" action="{{ route('domains.update', $domain) }}" x-data="{ selectedColor: '{{ old('color', $domain->color) }}' }">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        Domain name <span class="text-status-review">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name', $domain->name) }}"
                           placeholder="Ex: Laravel ORM, MySQL Avancé, API REST..."
                           class="w-full bg-gray-50 dark:bg-dark-700 border border-gray-300 dark:border-dark-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-dark-400 rounded-lg focus:ring-2 focus:ring-status-mastered focus:border-transparent transition"
                           required
                           autofocus>
                    @error('name')
                        <p class="mt-2 text-sm text-status-review">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-3">
                        Badge color <span class="text-status-review">*</span>
                    </label>

                    <div class="grid grid-cols-8 gap-3 mb-4">
                        @php
                            $colors = [
                                '#3B82F6', '#8B5CF6', '#EC4899', '#EF4444',
                                '#F59E0B', '#10B981', '#06B6D4', '#6366F1',
                                '#14B8A6', '#F97316', '#A855F7', '#84CC16',
                                '#22D3EE', '#FB923C', '#4ADE80', '#F472B6',
                            ];
                        @endphp

                        @foreach ($colors as $color)
                            <button type="button"
                                    @click="selectedColor = '{{ $color }}'"
                                    class="w-12 h-12 rounded-lg border-2 transition-all duration-200 hover:scale-110 active:scale-95"
                                    :class="selectedColor === '{{ $color }}' ? 'border-gray-900 dark:border-white ring-2 ring-status-mastered' : 'border-gray-300 dark:border-dark-600'"
                                    style="background-color: {{ $color }}">
                            </button>
                        @endforeach
                    </div>

                    <div class="flex items-center space-x-3 p-4 bg-gray-50 dark:bg-dark-700 rounded-lg">
                        <div class="w-8 h-8 rounded-full border-2 border-gray-300 dark:border-dark-500"
                             :style="'background-color: ' + selectedColor"></div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-dark-300">Selected color</p>
                            <p class="text-sm font-mono text-gray-900 dark:text-white" x-text="selectedColor"></p>
                        </div>
                    </div>

                    <input type="hidden" name="color" :value="selectedColor">

                    @error('color')
                        <p class="mt-2 text-sm text-status-review">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-dark-700">
                    <a href="{{ route('domains.index') }}"
                       class="px-6 py-3 bg-gray-100 dark:bg-dark-700 hover:bg-gray-200 dark:hover:bg-dark-600 text-gray-700 dark:text-white font-medium rounded-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-8 py-3 bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold rounded-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] inline-flex items-center shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save changes
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-6 bg-status-review/5 dark:bg-status-review/10 border border-status-review/30 dark:border-status-review rounded-xl p-6">
            <h3 class="font-semibold text-gray-900 dark:text-white mb-2 flex items-center">
                <svg class="w-5 h-5 mr-2 text-status-review" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                Danger zone
            </h3>
            <p class="text-gray-500 dark:text-dark-300 text-sm mb-4">
                Deleting a domain is permanent and will also delete all associated concepts.
            </p>
            <form method="POST" action="{{ route('domains.destroy', $domain) }}"
                  onsubmit="return confirm('⚠️ Are you absolutely sure?\n\nThis action will permanently delete the domain \"{{ $domain->name }}\" and all its concepts.\n\nThis action is irreversible.');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-6 py-3 bg-status-review hover:bg-status-review/80 text-white font-semibold rounded-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] shadow-sm">
                    Delete this domain
                </button>
            </form>
        </div>
    </div>
</x-app-layout>