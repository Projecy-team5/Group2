{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </div>
            <div class="mb-4 text-sm text-gray-600" x-cloak x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </div>
            <x-validation-errors class="mb-4" />
            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf
                <div class="mt-4" x-show="! recovery">
                    <x-label for="code" value="{{ __('Code') }}" />
                    <x-input id="code" class="block mt-1 w-full" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                </div>
                <div class="mt-4" x-cloak x-show="recovery">
                    <x-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                    <x-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </div>
                <div class="flex items-center justify-end mt-4">
                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Use a recovery code') }}
                    </button>
                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                    x-cloak
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Use an authentication code') }}
                    </button>
                    <x-button class="ms-4">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout> --}}
<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-indigo-100">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

            {{-- Logo --}}
            <div class="flex justify-center mb-6">
                <x-authentication-card-logo class="w-16 h-16" />
            </div>

            {{-- Title --}}
            <h2 class="text-center text-2xl font-bold text-gray-800 mb-4">
                {{ __('Two-Factor Authentication') }}
            </h2>

            {{-- Info --}}
            <div x-data="{ recovery: false }">
                <p class="text-sm text-gray-600 text-center mb-6" x-show="! recovery">
                    {{ __('Enter the authentication code from your authenticator app.') }}
                </p>
                <p class="text-sm text-gray-600 text-center mb-6" x-cloak x-show="recovery">
                    {{ __('Enter one of your emergency recovery codes.') }}
                </p>

                {{-- Errors --}}
                <x-validation-errors class="mb-4" />

                {{-- Form --}}
                <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-5">
                    @csrf

                    {{-- Authenticator Code --}}
                    <div x-show="! recovery">
                        <x-label for="code" value="{{ __('Authentication Code') }}" class="font-semibold text-gray-700" />
                        <x-input id="code"
                                 class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                 type="text"
                                 inputmode="numeric"
                                 name="code"
                                 autofocus
                                 x-ref="code"
                                 autocomplete="one-time-code" />
                    </div>

                    {{-- Recovery Code --}}
                    <div x-cloak x-show="recovery">
                        <x-label for="recovery_code" value="{{ __('Recovery Code') }}" class="font-semibold text-gray-700" />
                        <x-input id="recovery_code"
                                 class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                 type="text"
                                 name="recovery_code"
                                 x-ref="recovery_code"
                                 autocomplete="one-time-code" />
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-4">
                        <button type="button"
                                class="text-sm text-indigo-600 hover:text-indigo-800 underline cursor-pointer"
                                x-show="! recovery"
                                x-on:click="
                                    recovery = true;
                                    $nextTick(() => { $refs.recovery_code.focus() })
                                ">
                            {{ __('Use a recovery code') }}
                        </button>

                        <button type="button"
                                class="text-sm text-indigo-600 hover:text-indigo-800 underline cursor-pointer"
                                x-cloak
                                x-show="recovery"
                                x-on:click="
                                    recovery = false;
                                    $nextTick(() => { $refs.code.focus() })
                                ">
                            {{ __('Use an authentication code') }}
                        </button>

                        <x-button class="w-full sm:w-auto ms-0 sm:ms-4 py-2.5 flex justify-center items-center rounded-lg">
                            {{ __('Log In') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
