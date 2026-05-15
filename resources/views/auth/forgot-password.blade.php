<x-guest-layout>
    <div class="p-8">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Forgot Password?</h2>
            <p class="text-gray-500 dark:text-dark-400 text-sm mt-2">No problem. Enter your email and we'll send you a reset link.</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <x-primary-button class="w-full justify-center py-3">
                {{ __('Send Reset Link') }}
            </x-primary-button>

            <p class="text-center text-sm text-gray-500 dark:text-dark-400">
                <a href="{{ route('login') }}" class="text-status-mastered hover:text-status-mastered/80 font-medium transition-colors">Back to sign in</a>
            </p>
        </form>
    </div>
</x-guest-layout>