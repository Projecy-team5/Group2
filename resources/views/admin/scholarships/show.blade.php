@extends('layouts.dashboard')
@section('title', 'Scholarship Details')

@section('content')
    <div class="p-6 pt-5">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="text-blue-600">
                            <path d="M12 2L2 7l10 5 10-5-10-5z" />
                            <path d="M2 17l10 5 10-5" />
                            <path d="M2 12l10 5 10-5" />
                        </svg>
                        Scholarship Overview
                    </h2>
                    <p class="text-sm text-gray-600">View the saved information in the same form style.</p>
                </div>
                <div class="flex flex-col gap-2 sm:flex-row">
                    <a href="{{ route('admin.scholarships.edit', $scholarship) }}"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path
                                d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                        </svg>
                        Edit Scholarship
                    </a>
                    <a href="{{ route('admin.scholarships.index') }}"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-gray-500">
                                <path d="M12 2L2 7l10 5 10-5-10-5z" />
                            </svg>
                            Scholarship Name
                        </label>
                        <div
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 font-semibold shadow-sm">
                            {{ $scholarship->scholarship_name }}
                        </div>
                    </div>
                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-gray-500">
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                            Status
                        </label>
                        <div class="w-full">
                            <span
                                class="inline-flex items-center gap-2 px-4 py-3 rounded-lg border font-semibold text-sm
                                @if ($scholarship->status === 'active') bg-green-50 border-green-200 text-green-700
                                @elseif($scholarship->status === 'inactive') bg-yellow-50 border-yellow-200 text-yellow-700
                                @else
                                    bg-red-50 border-red-200 text-red-700 @endif">
                                <span class="inline-block w-2 h-2 rounded-full
                                    @if ($scholarship->status === 'active') bg-green-500
                                    @elseif($scholarship->status === 'inactive') bg-yellow-500
                                    @else
                                        bg-red-500 @endif"></span>
                                {{ ucfirst($scholarship->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-gray-500">
                                <line x1="12" y1="1" x2="12" y2="23" />
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                            </svg>
                            Award Amount
                        </label>
                        <div
                            class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-green-50 text-green-800 font-semibold shadow-sm relative">
                            <span class="absolute left-4 top-3 text-green-500 font-bold">$</span>
                            {{ number_format($scholarship->award_amount, 2) }}
                        </div>
                    </div>
                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-gray-500">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M8 12h8" />
                                <path d="M12 8v8" />
                            </svg>
                            Country
                        </label>
                        <div
                            class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-blue-50 text-blue-800 font-semibold shadow-sm">
                            {{ $scholarship->country }}
                        </div>
                    </div>
                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-gray-500">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            Application Deadline
                        </label>
                        <div
                            class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-purple-50 text-purple-800 font-semibold shadow-sm relative">
                            <span class="absolute left-4 top-3 text-purple-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                            </span>
                            {{ optional($scholarship->application_deadline)->format('F j, Y') ?? 'N/A' }}
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-gray-500">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <path d="M22 4L12 14.01l-3-3" />
                            </svg>
                            Eligibility Criteria
                        </label>
                        <div
                            class="block w-full pl-4 pr-3 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-800 shadow-sm whitespace-pre-line">
                            {{ $scholarship->eligibility_criteria }}
                        </div>
                    </div>
                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-gray-500">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            </svg>
                            Application Description
                        </label>
                        <div
                            class="block w-full pl-4 pr-3 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-800 shadow-sm whitespace-pre-line">
                            {{ $scholarship->application_description }}
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-gray-500">
                                <path d="M9 12l2 2 4-4" />
                                <path d="M21 12c-1 0-3-1-3-3s2-3 3-3 3 1 3 3-2 3-3 3" />
                                <path d="M3 12c1 0 3-1 3-3s-2-3-3-3-3 1-3 3 2 3 3 3" />
                                <path d="M3 12v6a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-6" />
                            </svg>
                            Application Requirements
                        </label>
                        @php
                            $requirements = $scholarship->application_requirements;
                            if (is_string($requirements)) {
                                $requirements = json_decode($requirements, true);
                            }
                            $requirements = is_array($requirements) ? $requirements : [];
                        @endphp
                        <div class="bg-gray-50 rounded-lg border border-gray-200 p-4 space-y-3">
                            @forelse($requirements as $requirement)
                                <div
                                    class="flex items-center gap-3 px-4 py-2 rounded-lg bg-white border border-gray-200 shadow-sm text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="text-blue-500">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <path d="M14 2v6h6" />
                                    </svg>
                                    <span>{{ $requirement }}</span>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 italic">No requirements provided.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-gray-500">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <polyline points="21 15 16 10 5 21" />
                            </svg>
                            Scholarship Gallery Images
                        </label>
                        <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @forelse($scholarship->images as $img)
                                    @php
                                        $rawPath = ltrim($img->image_path, '/');
                                        if (\Illuminate\Support\Str::startsWith($rawPath, ['http://', 'https://'])) {
                                            $imageUrl = $rawPath;
                                        } elseif (\Illuminate\Support\Str::startsWith($rawPath, 'storage/')) {
                                            $imageUrl = asset($rawPath);
                                        } else {
                                            $normalized = \Illuminate\Support\Str::startsWith($rawPath, 'public/')
                                                ? \Illuminate\Support\Str::replaceFirst('public/', '', $rawPath)
                                                : $rawPath;
                                            $imageUrl = Storage::url($normalized);
                                        }
                                    @endphp
                                    <div class="relative">
                                        <img src="{{ $imageUrl }}"
                                            class="rounded-lg h-24 w-full object-cover border border-gray-200 shadow"
                                            alt="Scholarship gallery image">
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500 italic col-span-full">No gallery images uploaded.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
