{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <x-validation-errors class="mb-4" />
        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" style="margin-right: 5px;">
                    {{ __('Register') }}
                </a>
                <x-button class="ms-4">
                    {{ __('Log in') }}
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
            <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">
                {{ __('Welcome Back') }}
            </h2>
            <x-validation-errors class="mb-4" />
            @session('status')
                <div
                    class="mb-4 text-sm font-medium text-green-600 bg-green-100 border border-green-200 rounded-lg p-3 text-center">
                    {{ $value }}
                </div>
            @endsession
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <x-label for="email" value="{{ __('Email Address') }}" class="text-gray-700 font-semibold" />
                    <x-input id="email"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>
                <div>
                    <x-label for="password" value="{{ __('Password') }}" class="text-gray-700 font-semibold" />
                    <x-input id="password"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="password" name="password" required autocomplete="current-password" />
                </div>
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember"
                            class="rounded text-indigo-600 focus:ring-indigo-500" />
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>
                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('register') }}"
                        class="px-4 py-2.5 w-1/2 text-center bg-gray-100 text-gray-800 font-semibold rounded-lg shadow-sm hover:bg-gray-200 transition">
                        {{ __('Register') }}
                    </a>
                    <x-button class="w-1/2 ms-3 py-2.5 flex justify-center items-center rounded-lg">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
