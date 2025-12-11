@extends('layouts.dashboard')
@section('title', __('Contact Message'))
@section('content')
    <div class="p-6 pt-0 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-900">{{ __('Contact Message') }}</h1>
        </div>
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="border-b border-gray-100 bg-gray-50 px-6 py-4">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $contact->subject }}</h2>
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="font-medium">{{ $contact->name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <a href="mailto:{{ $contact->email }}"
                                    class="text-blue-600 hover:underline">{{ $contact->email }}</a>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $contact->created_at->format('M j, Y') }} {{ __('at') }}
                                    {{ $contact->created_at->format('g:i A') }}</span>
                            </div>
                        </div>
                    </div>
                    @if ($contact->is_read)
                        <span
                            class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-800">
                            {{ __('Read') }}
                        </span>
                    @else
                        <span
                            class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800">
                            {{ __('New') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="px-6 py-8">
                <div class="prose max-w-none">
                    <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $contact->message }}</p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="border-t border-gray-100 bg-gray-50 px-6 py-4">
                <div class="flex items-center justify-end">
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-6 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-100"
                            onclick="showDeleteModal(this.form)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            {{ __('Delete Message') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-delete-confirmation />
    <x-toast />
@endsection
