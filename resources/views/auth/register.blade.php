@extends('layouts.homepage')
@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-indigo-100">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
            {{-- <div class="flex justify-center mb-6">
                <x-authentication-card-logo class="w-16 h-16" />
            </div> --}}
            <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">
                {{ __('Create an Account') }}
            </h2>
            <x-validation-errors class="mb-4" />
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div>
                    <x-label for="name" value="{{ __('Full Name') }}" class="text-gray-700 font-semibold" />
                    <x-input id="name"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>
                <div>
                    <x-label for="email" value="{{ __('Email Address') }}" class="text-gray-700 font-semibold" />
                    <x-input id="email"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>
                <div>
                    <x-label for="password" value="{{ __('Password') }}" class="text-gray-700 font-semibold" />
                    <x-input id="password"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="password" name="password" required autocomplete="new-password" />
                </div>
                <div>
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"
                        class="text-gray-700 font-semibold" />
                    <x-input id="password_confirmation"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="flex items-center mt-2">
                        <x-checkbox name="terms" id="terms" required
                            class="rounded text-indigo-600 focus:ring-indigo-500" />
                        <span class="ms-2 text-sm text-gray-600">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' =>
                                    '<a target="_blank" href="' .
                                    route('terms.show') .
                                    '" class="underline text-indigo-600 hover:text-indigo-800">' .
                                    __('Terms of Service') .
                                    '</a>',
                                'privacy_policy' =>
                                    '<a target="_blank" href="' .
                                    route('policy.show') .
                                    '" class="underline text-indigo-600 hover:text-indigo-800">' .
                                    __('Privacy Policy') .
                                    '</a>',
                            ]) !!}
                        </span>
                    </div>
                @endif
                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2.5 w-1/2 text-center bg-gray-100 text-gray-800 font-semibold rounded-lg shadow-sm hover:bg-gray-200 transition">
                        {{ __('Already registered?') }}
                    </a>
                    <x-button class="w-1/2 ms-3 py-2.5 flex justify-center items-center rounded-lg">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
@endsection
