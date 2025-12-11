@extends('layouts.homepage')
@section('content')
    <div class="min-h-screen flex items-center justify-center ">
        <div class="w-full max-w-md sm:max-w-lg px-4 sm:px-6 animate-fade-in">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl shadow-md border border-gray-200/20 p-6 relative">
                <div class="relative z-10">
                    <!-- Logo -->
                    {{-- <div class="flex justify-center mb-6">
                        <div class="w-14 h-14 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center shadow-sm">
                            <x-authentication-card-logo class="w-8 h-8 text-gray-900" />
                        </div>
                    </div> --}}
                    <div class="text-center mb-6">
                        <h2 class="text-2xl sm:text-3xl font-semibold text-gray-900 font-[Inter,Figtree,sans-serif]">
                            {{ __('Welcome Back') }}
                        </h2>
                        <p class="text-gray-700 text-sm font-normal font-[Inter,Figtree,sans-serif] mt-1">
                            {{ __('Sign in to your account') }}
                        </p>
                    </div>
                    <x-validation-errors class="mb-4" />
                    @session('status')
                        <div
                            class="mb-4 text-sm font-medium text-green-800 bg-green-100/80 backdrop-blur-sm border border-green-200/30 rounded-lg p-3 text-center shadow-sm">
                            {{ $value }}
                        </div>
                    @endsession
                    <form method="POST" action="{{ route('login') }}" class="space-y-3">
                        @csrf
                        <div class="space-y-1">
                            <x-label for="email" value="{{ __('Email Address') }}"
                                class="text-gray-900 font-medium text-sm font-[Inter,Figtree,sans-serif]" />
                            <x-input id="email"
                                class="w-full h-10 bg-white/10 backdrop-blur-sm border border-gray-200/30 rounded-lg px-4 text-gray-900 placeholder-gray-500 focus:border-indigo-600 transition-all duration-200 text-sm"
                                type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                                placeholder="Enter your email" />
                        </div>
                        <div class="space-y-1">
                            <x-label for="password" value="{{ __('Password') }}"
                                class="text-gray-900 font-medium text-sm font-[Inter,Figtree,sans-serif]" />
                            <x-input id="password"
                                class="w-full h-10 bg-white/10 backdrop-blur-sm border border-gray-200/30 rounded-lg px-4 text-gray-900 placeholder-gray-500 focus:border-indigo-600 transition-all duration-200 text-sm"
                                type="password" name="password" required autocomplete="current-password"
                                placeholder="Enter your password" />
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <label for="remember_me" class="flex items-center group cursor-pointer">
                                <x-checkbox id="remember_me" name="remember"
                                    class="rounded bg-white/10 border-gray-200/30 text-indigo-600 focus:ring-indigo-600 focus:ring-1" />
                                <span
                                    class="ml-2 text-sm text-gray-700 font-normal group-hover:text-gray-900 transition-colors font-[Inter,Figtree,sans-serif]">
                                    {{ __('Remember me') }}
                                </span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm text-gray-700 hover:text-indigo-600 transition-colors hover:underline font-[Inter,Figtree,sans-serif]">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="flex gap-3 pt-3">
                            <a href="{{ route('register') }}"
                                class="flex-1 h-10 bg-white/10 backdrop-blur-sm hover:bg-white/20 border border-gray-200/30 text-gray-900 font-medium rounded-lg transition-all duration-200 flex items-center justify-center text-sm">
                                {{ __('Register') }}
                            </a>
                            <x-button
                                class="flex-1 h-10 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-all duration-200 text-sm">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
        }
    </style>
@endsection
