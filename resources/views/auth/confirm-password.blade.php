{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>
        <x-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>
            <div class="flex justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}
<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-indigo-100">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
            <div class="flex justify-center mb-6">
                <x-authentication-card-logo class="w-16 h-16" />
            </div>
            <h2 class="text-center text-2xl font-bold text-gray-800 mb-4">
                {{ __('Confirm Password') }}
            </h2>
            <p class="text-sm text-gray-600 text-center mb-6">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </p>
            <x-validation-errors class="mb-4" />
            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                @csrf
                <div>
                    <x-label for="password" value="{{ __('Password') }}" class="text-gray-700 font-semibold" />
                    <x-input id="password"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="password" name="password" required autocomplete="current-password" autofocus />
                </div>
                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2.5 w-1/2 text-center bg-gray-100 text-gray-800 font-semibold rounded-lg shadow-sm hover:bg-gray-200 transition">
                        {{ __('Back to Login') }}
                    </a>
                    <x-button class="w-1/2 ms-3 py-2.5 flex justify-center items-center rounded-lg">
                        {{ __('Confirm') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
