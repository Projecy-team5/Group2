@extends('layouts.dashboard')

@section('content')
    <div class="p-6 pt-0 space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 px-6 py-5">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">User Details</h1>
                    <p class="text-sm text-slate-500">A quick snapshot of this account.</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-slate-300 hover:bg-slate-50">
                        ← Back to list
                    </a>
                    <a href="{{ route('admin.users.edit', $user) }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-sky-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-600">
                        Edit User
                    </a>
                </div>
            </div>
            <div class="px-6 py-6">
                <div class="flex flex-col gap-6 lg:flex-row">
                    <div class="flex flex-1 items-center gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5 shadow-sm">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                class="h-20 w-20 rounded-full border border-slate-200 object-cover shadow" />
                        @else
                            <div
                                class="flex h-20 w-20 items-center justify-center rounded-full border border-slate-200 bg-slate-100 text-2xl font-semibold text-slate-600">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <h2 class="text-2xl font-semibold text-slate-900">{{ $user->name }}</h2>
                            <p class="text-sm text-slate-500">ID #{{ $user->id }}</p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @if ($user->email_verified_at)
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        Verified
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700">
                                        Unverified
                                    </span>
                                @endif
                                @if ($user->role)
                                    <span class="inline-flex items-center rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-700">
                                        {{ $user->role->name }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <dl class="grid grid-cols-1 gap-4 text-sm text-slate-600 sm:grid-cols-2">
                            <div>
                                <dt class="font-semibold text-slate-500">Email</dt>
                                <dd class="text-slate-800">{{ $user->email }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold text-slate-500">Role</dt>
                                <dd class="text-slate-800">{{ $user->role->name ?? '—' }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold text-slate-500">Member since</dt>
                                <dd class="text-slate-800">{{ $user->created_at->format('M d, Y') }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold text-slate-500">Last updated</dt>
                                <dd class="text-slate-800">{{ $user->updated_at->format('M d, Y') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="mt-6 flex flex-wrap justify-end gap-3 border-t border-slate-100 pt-4">
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            class="inline-flex items-center gap-2 rounded-xl border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-600 shadow-sm transition hover:bg-rose-50"
                            onclick="showDeleteModal(this.form)">
                            Delete User
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <x-delete-confirmation />
    </div>
@endsection
