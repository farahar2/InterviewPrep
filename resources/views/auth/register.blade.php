<x-guest-layout>
    <div class="p-8">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Create Account</h2>
            <p class="text-gray-500 dark:text-dark-400 text-sm mt-2">Start tracking your interview preparation</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1.5 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1.5 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1.5 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <x-primary-button class="w-full justify-center py-3">
                {{ __('Create Account') }}
            </x-primary-button>

            <p class="text-center text-sm text-gray-500 dark:text-dark-400">
                Already have an account?
                <a href="{{ route('login') }}" class="text-status-mastered hover:text-status-mastered/80 font-medium transition-colors">Sign in</a>
            </p>
        </form>
    </div>
</x-guest-layout>