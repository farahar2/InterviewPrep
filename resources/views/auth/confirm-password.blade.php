<x-guest-layout>
    <div class="p-8">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Confirm Password</h2>
            <p class="text-gray-500 dark:text-dark-400 text-sm mt-2">This is a secure area. Please confirm your password before continuing.</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1.5 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <x-primary-button class="w-full justify-center py-3">
                {{ __('Confirm') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>