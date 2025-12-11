@extends('layouts.dashboard')

@section('content')
    <div class="p-6 pt-0 space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-4 py-2">
            <div class="flex flex-col gap-1">
                <h1 class="text-xl font-bold text-gray-900">{{ __('Role Management') }}</h1>
                <p class="text-sm text-gray-500">
                    {{ __('Keep the directory of roles visually aligned with the scholarship tables.') }}
                </p>
            </div>
            <a href="{{ route('admin.roles.create') }}"
                class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 rounded-md px-4 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus" aria-hidden="true">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
                {{ __('New Role') }}
            </a>
        </div>

        <div class="rounded-md border border-[#b8bbc0] bg-white p-4 shadow-sm">
            <form method="GET" action="{{ route('admin.roles.index') }}"
                class="grid gap-4 md:grid-cols-[minmax(0,1fr)_auto] md:items-end">
                <div>
                    <label for="search" class="mb-1 block text-sm font-medium text-gray-700">{{ __('Search Roles') }}</label>
                    <div class="relative">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="{{ __('Search by name or description') }}"
                            class="w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-4 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="pointer-events-none absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-md border border-blue-600 bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700">
                        {{ __('Filter') }}
                    </button>
                    <a href="{{ route('admin.roles.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                        {{ __('Reset') }}
                    </a>
                </div>
            </form>
        </div>

        @if (session('success'))
            <div class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif

        <div class="rounded-md border border-[#b8bbc0] bg-white">
            <div class="relative w-full overflow-auto">
                <table class="w-full caption-bottom text-sm">
                    <thead class="[&_tr]:border-b bg-gray-50">
                        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                            <th
                                class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                {{ __('Role') }}</th>
                            <th
                                class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                {{ __('Description') }}</th>
                            <th
                                class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                {{ __('Users') }}</th>
                            <th
                                class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                {{ __('Access') }}</th>
                            <th
                                class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 w-[120px]">
                                {{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="[&_tr:last-child]:border-0">
                        @forelse ($roles as $role)
                            <tr
                                class="border-b data-[state=selected]:bg-muted hover:bg-gray-50 transition-colors duration-200">
                                <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-lg border border-indigo-200 bg-indigo-50 text-indigo-600 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-shield" aria-hidden="true">
                                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $role->name }}</div>
                                            <div class="text-xs uppercase tracking-wide text-gray-500">{{ $role->slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0 text-gray-600">
                                    {{ $role->description ?? __('No description provided') }}
                                </td>
                                <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full border border-blue-100 bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-users h-3.5 w-3.5">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                        {{ $role->users_count }} {{ \Illuminate\Support\Str::plural('user', $role->users_count) }}
                                    </span>
                                </td>
                                <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                    @if ($role->is_admin)
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full border border-red-200 bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-crown h-4 w-4">
                                                <path d="m3 11 2-4 4 3 3-5 3 5 4-3 2 4v8H3z"></path>
                                            </svg>
                                            {{ __('Admin access') }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full border border-gray-200 bg-gray-50 px-3 py-1 text-xs font-medium text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-badge-check h-4 w-4">
                                                <path d="M15 9.354 17.5 12l-7.5 7.5L5 14.5l2.5-2.5"></path>
                                                <path
                                                    d="M16.5 20.886A7.052 7.052 0 0 0 21 14v-4a7 7 0 0 0-14 0v4a7.052 7.052 0 0 0 4.5 6.886">
                                                </path>
                                            </svg>
                                            {{ __('Standard access') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.roles.edit', $role) }}"
                                            class="inline-flex items-center gap-1 rounded-md border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-800 transition hover:bg-gray-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-pencil-line h-4 w-4">
                                                <path d="M12 20h9"></path>
                                                <path
                                                    d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4z">
                                                </path>
                                            </svg>
                                            {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST"
                                            class="inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('{{ __('Delete this role?') }}')"
                                                class="inline-flex items-center gap-1 rounded-md border border-rose-200 bg-rose-50 px-3 py-1.5 text-xs font-medium text-rose-700 transition hover:bg-rose-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-trash-2 h-4 w-4">
                                                    <polyline points="3 6 5 6 21 6" />
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    <line x1="10" x2="10" y1="11" y2="17" />
                                                    <line x1="14" x2="14" y1="11" y2="17" />
                                                </svg>
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-user-round h-8 w-8 text-gray-400">
                                            <path d="M18 20a6 6 0 0 0-12 0"></path>
                                            <circle cx="12" cy="10" r="4"></circle>
                                        </svg>
                                        <span>{{ __('No roles yet. Create your first role to control access.') }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($roles instanceof \Illuminate\Pagination\LengthAwarePaginator && $roles->hasPages())
                <div
                    class="flex flex-col gap-4 border-t border-gray-200 bg-white px-4 py-3 text-sm text-gray-600 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-gray-600">
                        {{ __('Showing') }}
                        <span class="font-semibold text-gray-900">{{ $roles->firstItem() }}</span>
                        {{ __('to') }}
                        <span class="font-semibold text-gray-900">{{ $roles->lastItem() }}</span>
                        {{ __('of') }}
                        <span class="font-semibold text-gray-900">{{ $roles->total() }}</span>
                        {{ __('results') }}
                    </p>
                    <div class="flex items-center justify-between gap-2 sm:justify-end">
                        @if ($roles->onFirstPage())
                            <span
                                class="inline-flex items-center rounded-md border border-gray-200 bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-400 cursor-not-allowed">{{ __('Previous') }}</span>
                        @else
                            <a href="{{ $roles->previousPageUrl() }}"
                                class="inline-flex items-center rounded-md border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 transition hover:bg-gray-50">{{ __('Previous') }}</a>
                        @endif

                        <div class="hidden items-center gap-1 sm:flex">
                            @foreach ($roles->getUrlRange(1, $roles->lastPage()) as $page => $url)
                                @if ($page === $roles->currentPage())
                                    <span
                                        class="inline-flex items-center rounded-md bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}"
                                        class="inline-flex items-center rounded-md border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 transition hover:bg-gray-50">{{ $page }}</a>
                                @endif
                            @endforeach
                        </div>

                        @if ($roles->hasMorePages())
                            <a href="{{ $roles->nextPageUrl() }}"
                                class="inline-flex items-center rounded-md border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 transition hover:bg-gray-50">{{ __('Next') }}</a>
                        @else
                            <span
                                class="inline-flex items-center rounded-md border border-gray-200 bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-400 cursor-not-allowed">{{ __('Next') }}</span>
                        @endif
                    </div>
                </div>
            @else
                <div class="border-t border-gray-200 px-4 py-3">
                    {{ $roles->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
