<x-guest-layout>
    <div class="p-8">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome Back</h2>
            <p class="text-gray-500 dark:text-dark-400 text-sm mt-2">Sign in to continue your interview prep</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1.5 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-dark-600 bg-white dark:bg-dark-700 text-status-mastered shadow-sm focus:ring-status-mastered" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-dark-300">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-status-mastered hover:text-status-mastered/80 font-medium transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-primary-button class="w-full justify-center py-3">
                {{ __('Sign In') }}
            </x-primary-button>

            <p class="text-center text-sm text-gray-500 dark:text-dark-400">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-status-mastered hover:text-status-mastered/80 font-medium transition-colors">Sign up</a>
            </p>
        </form>
    </div>
</x-guest-layout>