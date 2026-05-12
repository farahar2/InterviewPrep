<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('domains.index') }}" 
               class="text-dark-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-bold text-3xl text-white">
                Create a New Domain
            </h2>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-0">
        <div class="bg-dark-800 rounded-lg p-8 border border-dark-700">
            <form method="POST" action="{{ route('domains.store') }}" x-data="{ selectedColor: '#3B82F6' }">
                @csrf

                <!-- Nom du domaine -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-white mb-2">
                        Domain name <span class="text-status-review">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           placeholder="Ex: Laravel ORM, MySQL Avancé, API REST..."
                           class="w-full bg-dark-700 border-dark-600 text-white placeholder-dark-400 rounded-lg focus:ring-2 focus:ring-status-mastered focus:border-transparent transition"
                           required
                           autofocus>
                    @error('name')
                        <p class="mt-2 text-sm text-status-review">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Color Picker -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-white mb-3">
                        Badge color <span class="text-status-review">*</span>
                    </label>
                    
                    <!-- Palette de couleurs prédéfinies -->
                    <div class="grid grid-cols-8 gap-3 mb-4">
                        @php
                            $colors = [
                                '#3B82F6', // Bleu
                                '#8B5CF6', // Violet
                                '#EC4899', // Rose
                                '#EF4444', // Rouge
                                '#F59E0B', // Orange
                                '#10B981', // Vert
                                '#06B6D4', // Cyan
                                '#6366F1', // Indigo
                                '#14B8A6', // Teal
                                '#F97316', // Orange vif
                                '#A855F7', // Purple
                                '#84CC16', // Lime
                                '#22D3EE', // Sky
                                '#FB923C', // Orange light
                                '#4ADE80', // Green light
                                '#F472B6', // Pink light
                            ];
                        @endphp

                        @foreach ($colors as $color)
                            <button type="button"
                                    @click="selectedColor = '{{ $color }}'"
                                    class="w-12 h-12 rounded-lg border-2 transition-all duration-200 hover:scale-110"
                                    :class="selectedColor === '{{ $color }}' ? 'border-white ring-2 ring-status-mastered' : 'border-dark-600'"
                                    style="background-color: {{ $color }}">
                            </button>
                        @endforeach
                    </div>

                    <!-- Aperçu de la couleur sélectionnée -->
                    <div class="flex items-center space-x-3 p-4 bg-dark-700 rounded-lg">
                        <div class="w-8 h-8 rounded-full border-2 border-dark-500" 
                             :style="'background-color: ' + selectedColor"></div>
                        <div>
                            <p class="text-sm text-dark-300">Couleur sélectionnée</p>
                            <p class="text-sm font-mono text-white" x-text="selectedColor"></p>
                        </div>
                    </div>

                    <!-- Input caché pour envoyer la couleur -->
                    <input type="hidden" name="color" :value="selectedColor">
                    
                    @error('color')
                        <p class="mt-2 text-sm text-status-review">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Boutons -->
                <div class="flex items-center justify-between pt-6 border-t border-dark-700">
                    <a href="{{ route('domains.index') }}" 
                       class="px-6 py-3 bg-dark-700 hover:bg-dark-600 text-white font-medium rounded-lg transition">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-status-mastered hover:bg-status-mastered/80 text-white font-semibold rounded-lg transition inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Créer le domaine
                    </button>
                </div>
            </form>
        </div>

        <!-- Carte d'aide -->
        <div class="mt-6 bg-dark-800/50 border border-dark-700 rounded-lg p-6">
            <h3 class="font-semibold text-white mb-2 flex items-center">
                <svg class="w-5 h-5 mr-2 text-status-mastered" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                Astuce
            </h3>
            <p class="text-dark-300 text-sm">
                Un domaine représente une catégorie technique (ex: Laravel, MySQL, Docker). 
                Choisissez une couleur distinctive pour le retrouver facilement dans votre liste.
            </p>
        </div>
    </div>
</x-app-layout>