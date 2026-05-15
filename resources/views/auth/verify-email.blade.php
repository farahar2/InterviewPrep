<x-guest-layout>
    <div class="p-8">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Verify Email</h2>
            <p class="text-gray-500 dark:text-dark-400 text-sm mt-2">Thanks for signing up! Verify your email to get started.</p>
        </div>

        <div class="bg-gray-50 dark:bg-dark-700 rounded-xl p-6 border border-gray-200 dark:border-dark-600 mb-6">
            <p class="text-sm text-gray-600 dark:text-dark-300 leading-relaxed">
                {{ __('Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 text-sm text-status-mastered bg-status-mastered/5 border border-status-mastered/20 rounded-lg px-4 py-3">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-500 dark:text-dark-400 hover:text-status-review transition-colors font-medium">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>