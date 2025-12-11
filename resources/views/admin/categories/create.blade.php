@extends('layouts.dashboard')
@section('content')
    <div class="p-6 pt-0 space-y-6">
        <div class="flex flex-wrap items-start justify-between gap-4">
        </div>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-gray-100 px-6 py-4">
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h10m-7 6h7" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">{{__('Category Details')}}</h2>
                        <p class="text-sm text-gray-500">{{__('Name the collection and add a short description for editors.')}}</p>
                    </div>
                </div>
                <form action="{{ route('admin.categories.store') }}" method="POST" class="px-6 py-6">
                    @csrf
                    <div class="space-y-6">
                        <div class="group">
                            <div class="flex items-center justify-between">
                                <label for="name" class="text-sm font-medium text-gray-700">{{__('Category name')}}</label>
                                <span class="text-xs font-medium uppercase tracking-wide text-gray-400">{{__('Required')}}</span>
                            </div>
                            <div class="relative mt-2">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 pl-11 text-gray-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 focus:border-red-500 focus:ring-red-500 @enderror"
                                    placeholder="e.g., Student Life" autocomplete="off">
                                <span
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 20l9-5-9-5-9 5 9 5z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 12l9-5-9-5-9 5 9 5z" />
                                    </svg>
                                </span>
                            </div>
                            @error('name')
                                <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="15" y1="9" x2="9" y2="15" />
                                        <line x1="9" y1="9" x2="15" y2="15" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">{{__('The slug is generated automatically and can be edited later.')}}</p>
                                later.</p>
                        </div>
                        <div class="group">
                            <div class="flex items-center justify-between">
                                <label for="description" class="text-sm font-medium text-gray-700">{{__('Description')}}</label>
                                <span class="text-xs font-medium text-gray-400">{{__('Optional')}}</span>
                            </div>
                            <div class="relative mt-2">
                                <textarea name="description" id="description" rows="4"
                                    class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 pl-11 text-gray-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500"
                                    placeholder="{{__('Explain when to use this category')}}">{{ old('description') }}</textarea>
                                <span class="pointer-events-none absolute top-3 left-4 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4-.83L3 20l1.53-3.58A8.68 8.68 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </span>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">{{__('Used on the detail page and within the newsroom filter panel.')}}</p>
                        </div>
                    </div>
                    <div class="mt-8 flex flex-wrap items-center justify-end gap-3 border-t border-gray-100 pt-5">
                        <a href="{{ route('admin.categories.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:border-gray-300 hover:bg-gray-50">
                            {{__('Cancel')}}
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            {{__('Create category')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
