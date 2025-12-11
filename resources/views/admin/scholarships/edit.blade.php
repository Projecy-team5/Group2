{{-- resources/views/admin/scholarships/edit.blade.php --}}
@extends('layouts.dashboard')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <div class="p-6 pt-0">
        <div class="space-y-4">
            <div class="flex items-center py-2 justify-between gap-4">
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-blue-600">
                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path
                                d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                        </svg>
                        {{__('Scholarship Information')}}
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">{{__('Update the scholarship details, requirements, and application
                        information')}}</p>
                </div>

                <form action="{{ route('admin.scholarships.update', $scholarship) }}" method="POST"
                    enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <!-- Scholarship Name -->
                        <div class="group">
                            <label for="scholarship_name"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-gray-500">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                    <path d="M2 17l10 5 10-5" />
                                    <path d="M2 12l10 5 10-5" />
                                </svg>
                                {{ __('Scholarship Name') }}
                            </label>
                            <div class="relative">
                                <input type="text" name="scholarship_name" id="scholarship_name"
                                    value="{{ old('scholarship_name', $scholarship->scholarship_name) }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white"
                                    placeholder="e.g., The John Doe Memorial Scholarship" required>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="text-gray-400">
                                        <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                        <path d="M2 17l10 5 10-5" />
                                        <path d="M2 12l10 5 10-5" />
                                    </svg>
                                </div>
                            </div>
                            @error('scholarship_name')
                                <div class="mt-2 flex items-center gap-2 text-sm text-red-600"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="15" y1="9" x2="9" y2="15" />
                                        <line x1="9" y1="9" x2="15" y2="15" />
                                    </svg>{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Grid: Amount, Country, Deadline -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="group">
                                <label for="award_amount"
                                    class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                        <line x1="12" y1="1" x2="12" y2="23" />
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                    </svg>
                                   {{__('Award Amount')}}
                                </label>
                                <div class="relative">
                                    <input type="number" name="award_amount" id="award_amount"
                                        value="{{ old('award_amount', $scholarship->award_amount) }}"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white"
                                        placeholder="5000.00" step="0.01" min="0" required>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-gray-400">
                                            <line x1="12" y1="1" x2="12" y2="23" />
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                        </svg>
                                    </div>
                                </div>
                                @error('award_amount')
                                    <div class="mt-2 flex items-center gap-2 text-sm text-red-600"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="15" y1="9" x2="9" y2="15" />
                                            <line x1="9" y1="9" x2="15" y2="15" />
                                        </svg>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="country"
                                    class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M8 12h8" />
                                        <path d="M12 8v8" />
                                    </svg>
                                    {{__('Country')}}
                                </label>
                                <div class="relative">
                                    <input type="text" name="country" id="country"
                                        value="{{ old('country', $scholarship->country) }}"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white"
                                        placeholder="e.g., United States" required>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-gray-400">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M8 12h8" />
                                            <path d="M12 8v8" />
                                        </svg>
                                    </div>
                                </div>
                                @error('country')
                                    <div class="mt-2 flex items-center gap-2 text-sm text-red-600"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="15" y1="9" x2="9" y2="15" />
                                            <line x1="9" y1="9" x2="15" y2="15" />
                                        </svg>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="application_deadline"
                                    class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                    {{__('Application Deadline')}}
                                </label>
                                <div class="relative">
                                    <input type="text" name="application_deadline" id="application_deadline"
                                        value="{{ old('application_deadline', $scholarship->application_deadline ? ($scholarship->application_deadline instanceof \Carbon\Carbon ? $scholarship->application_deadline->format('Y-m-d') : null) : null) }}"
                                        class="date-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white"
                                        required>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-gray-400">
                                            <rect width="18" height="18" x="3" y="4" rx="2"
                                                ry="2" />
                                            <line x1="16" y1="2" x2="16" y2="6" />
                                            <line x1="8" y1="2" x2="8" y2="6" />
                                            <line x1="3" y1="10" x2="21" y2="10" />
                                        </svg>
                                    </div>
                                </div>
                                @error('application_deadline')
                                    <div class="mt-2 flex items-center gap-2 text-sm text-red-600"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="15" y1="9" x2="9" y2="15" />
                                            <line x1="9" y1="9" x2="15" y2="15" />
                                        </svg>{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="group">
                            <label for="status"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M9 12l2 2 4-4" />
                                </svg>
                                {{__('Status')}}
                            </label>
                            <div class="relative">
                                <select name="status" id="status"
                                    class="block w-full pl-10 pr-8 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white"
                                    required>
                                    <option value="active"
                                        {{ old('status', $scholarship->status) == 'active' ? 'selected' : '' }}>{{__('Active')}}
                                    </option>
                                    <option value="inactive"
                                        {{ old('status', $scholarship->status) == 'inactive' ? 'selected' : '' }}>{{__('Inactive')}}
                                    </option>
                                    <option value="closed"
                                        {{ old('status', $scholarship->status) == 'closed' ? 'selected' : '' }}>{{__('Closed')}}
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="text-gray-400">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M9 12l2 2 4-4" />
                                    </svg>
                                </div>
                            </div>
                            @error('status')
                                <div class="mt-2 flex items-center gap-2 text-sm text-red-600"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="15" y1="9" x2="9" y2="15" />
                                        <line x1="9" y1="9" x2="15" y2="15" />
                                    </svg>{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Eligibility & Description -->
                        <div class="group">
                            <label for="eligibility_criteria"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <path d="M22 4L12 14.01l-3-3" />
                                </svg>
                            {{__('Eligibility Criteria')}}
                            </label>
                            <textarea name="eligibility_criteria" id="eligibility_criteria" rows="4"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white"
                                placeholder="e.g., Must be a high school senior with a minimum GPA of 3.5." required>{{ old('eligibility_criteria', $scholarship->eligibility_criteria) }}</textarea>
                            @error('eligibility_criteria')
                                <div class="mt-2 flex items-center gap-2 text-sm text-red-600"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="15" y1="9" x2="9" y2="15" />
                                        <line x1="9" y1="9" x2="15" y2="15" />
                                    </svg>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="group">
                            <label for="application_description"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <path d="M14 2v6h6" />
                                    <line x1="16" y1="13" x2="8" y2="13" />
                                    <line x1="16" y1="17" x2="8" y2="17" />
                                    <line x1="10" y1="9" x2="8" y2="9" />
                                </svg>
                                {{__('Application Description')}}
                            </label>
                            <textarea name="application_description" id="application_description" rows="4"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white"
                                placeholder="Provide a detailed description for applicants." required>{{ old('application_description', $scholarship->application_description) }}</textarea>
                            @error('application_description')
                                <div class="mt-2 flex items-center gap-2 text-sm text-red-600"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="15" y1="9" x2="9" y2="15" />
                                        <line x1="9" y1="9" x2="15" y2="15" />
                                    </svg>{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Application Requirements (Dynamic) -->
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                        <path d="M9 12l2 2 4-4" />
                                        <path d="M21 12c-1 0-3-1-3-3s2-3 3-3 3 1 3 3-2 3-3 3" />
                                        <path d="M3 12c1 0 3-1 3-3s-2-3-3-3-3 1-3 3 2 3 3 3" />
                                        <path d="M3 12v6a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-6" />
                                    </svg>
                                   {{__('Application Requirements')}}
                                </label>
                                <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                                    <div id="requirements-container" class="space-y-3">
                                        @php
                                            $requirements = old('application_requirements');
                                            if (!$requirements && $scholarship->application_requirements) {
                                                $requirements = is_array($scholarship->application_requirements)
                                                    ? $scholarship->application_requirements
                                                    : json_decode($scholarship->application_requirements, true);
                                            }
                                            $requirements = is_array($requirements) ? $requirements : [''];
                                            if (
                                                empty($requirements) ||
                                                (count($requirements) === 1 && empty($requirements[0]))
                                            ) {
                                                $requirements = [''];
                                            }
                                        @endphp
                                        @foreach ($requirements as $requirement)
                                            <div
                                                class="requirement-item flex items-stretch rounded-lg border border-gray-300 shadow-sm overflow-hidden bg-white">
                                                <div class="relative flex-1">
                                                    <input type="text" name="application_requirements[]"
                                                        value="{{ old('application_requirements.' . $loop->index, $requirement) }}"
                                                        class="block w-full pl-10 pr-3 py-3 border-0 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                        placeholder="e.g., Official transcripts" required>
                                                    <div
                                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path
                                                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                            <path d="M14 2v6h6" />
                                                            <line x1="16" y1="13" x2="8"
                                                                y2="13" />
                                                            <line x1="16" y1="17" x2="8"
                                                                y2="17" />
                                                            <line x1="10" y1="9" x2="8"
                                                                y2="9" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                @if ($loop->first)
                                                    <button type="button" id="add-requirement"
                                                        class="add-requirement flex items-center justify-center w-14 bg-blue-500 hover:bg-blue-600 text-white transition-colors"
                                                        aria-label="Add requirement">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M5 12h14" />
                                                            <path d="M12 5v14" />
                                                        </svg>
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        class="remove-requirement flex items-center justify-center w-14 bg-red-500 hover:bg-red-600 text-white transition-colors"
                                                        aria-label="Remove requirement">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M5 12h14" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @error('application_requirements')
                                    <div class="mt-2 flex items-center gap-2 text-sm text-red-600"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="15" y1="9" x2="9" y2="15" />
                                            <line x1="9" y1="9" x2="15" y2="15" />
                                        </svg>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21 15 16 10 5 21" />
                                    </svg>
                                    Edit Gallery Images (Max 10 total, 2MB each)
                                </label>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                    @forelse($scholarship->images as $img)
                                        @php
                                            $rawPath = ltrim($img->image_path, '/');
                                            if (
                                                \Illuminate\Support\Str::startsWith($rawPath, ['http://', 'https://'])
                                            ) {
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
                                        <div class="relative group" id="img-wrapper-{{ $img->id }}">
                                            <img src="{{ $imageUrl }}" id="img-{{ $img->id }}"
                                                class="rounded-lg h-28 w-full object-cover border border-gray-200 shadow transition-all"
                                                alt="Gallery image">
                                            <button type="button"
                                                class="toggle-existing absolute top-2 right-2 bg-white/85 text-gray-700 hover:bg-white hover:text-red-600 p-1.5 rounded-full shadow flex items-center justify-center transition-all"
                                                data-id="{{ $img->id }}" aria-label="Mark for removal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M18 6 6 18" />
                                                    <path d="M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <span id="label-{{ $img->id }}"
                                                class="existing-label hidden absolute bottom-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded font-medium">Will be removed</span>
                                            <input type="checkbox" name="remove_gallery_images[]"
                                                value="{{ $img->id }}" id="remove-img-{{ $img->id }}"
                                                class="hidden">
                                        </div>
                                    @empty
                                        <p class="text-gray-500 italic col-span-full">No gallery images yet.</p>
                                    @endforelse
                                </div>

                                <input type="file" name="gallery_images[]" id="gallery_images"
                                    accept="image/jpeg,image/jpg,image/png" multiple
                                    class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @if ($scholarship->images->count() < 10)
                                    <p class="text-xs text-gray-500 mt-1">You may add up to
                                        {{ 10 - $scholarship->images->count() }} more images.</p>
                                @else
                                    <p class="text-xs text-orange-600 mt-1">You have reached the maximum of 10 images. Please remove some images before adding new ones.</p>
                                @endif
                                <div id="gallery-preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 hidden"></div>

                                @error('gallery_images')
                                    <div class="mt-2 flex items-center gap-2 text-sm text-red-600"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="15" y1="9" x2="9" y2="15" />
                                            <line x1="9" y1="9" x2="15" y2="15" />
                                        </svg>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-gray-200 mt-8">
                        <a href="{{ route('admin.scholarships.index') }}"
                            class="px-6 py-3 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition">
                           {{__('Cancel')}}
                        </a>
                        <button type="submit" id="submit-btn"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm hover:shadow-md transition flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <polyline points="17,21 17,13 7,13 7,21" />
                                <polyline points="7,3 7,8 15,8" />
                            </svg>
                            {{__('Update Scholarship')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('requirements-container');
            const addButton = document.getElementById('add-requirement');
            const deadlineInput = document.getElementById('application_deadline');
            const galleryInput = document.getElementById('gallery_images');
            const galleryPreview = document.getElementById('gallery-preview');

            if (deadlineInput && window.flatpickr) {
                flatpickr(deadlineInput, {
                    altInput: true,
                    altFormat: 'F j, Y',
                    dateFormat: 'Y-m-d',
                    defaultDate: deadlineInput.value || null
                });
            }

            if (container && addButton) {
                const createRequirementItem = () => {
                    const item = document.createElement('div');
                    item.className =
                        'requirement-item flex items-stretch rounded-lg border border-gray-300 shadow-sm overflow-hidden bg-white';
                    item.innerHTML = `
                        <div class="relative flex-1">
                            <input type="text" name="application_requirements[]"
                                class="block w-full pl-10 pr-3 py-3 border-0 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="e.g., Personal Statement" required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <path d="M14 2v6h6"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                    <line x1="10" y1="9" x2="8" y2="9"/>
                                </svg>
                            </div>
                        </div>
                        <button type="button"
                            class="remove-requirement flex items-center justify-center w-14 bg-red-500 hover:bg-red-600 text-white transition-colors"
                            aria-label="Remove requirement">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M5 12h14" />
                            </svg>
                        </button>
                    `;
                    return item;
                };

                addButton.addEventListener('click', () => {
                    const item = createRequirementItem();
                    container.appendChild(item);
                    item.querySelector('input')?.focus();
                });

                container.addEventListener('click', (event) => {
                    const removeBtn = event.target.closest('.remove-requirement');
                    if (!removeBtn) {
                        return;
                    }

                    const item = removeBtn.closest('.requirement-item');
                    if (item) {
                        item.remove();
                    }
                });
            }

            if (galleryInput && galleryPreview) {
                let selectedFiles = [];

                const renderPreview = () => {
                    galleryPreview.innerHTML = '';
                    if (!selectedFiles.length) {
                        galleryPreview.classList.add('hidden');
                        return;
                    }

                    selectedFiles.forEach((file, index) => {
                        const url = URL.createObjectURL(file);
                        const wrapper = document.createElement('div');
                        wrapper.className = 'relative group';
                        wrapper.innerHTML = `
                            <img src="${url}" class="h-28 w-full object-cover rounded-lg border border-gray-200 shadow">
                            <button type="button" data-preview-index="${index}"
                                class="remove-preview absolute top-2 right-2 bg-white/80 text-gray-700 hover:bg-white p-1 rounded-full shadow hidden group-hover:flex"
                                aria-label="Remove preview">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </button>
                        `;
                        galleryPreview.appendChild(wrapper);
                        wrapper.querySelector('img').addEventListener('load', () => URL.revokeObjectURL(
                            url));
                    });
                    galleryPreview.classList.remove('hidden');
                };

                const syncInputFiles = () => {
                    const dt = new DataTransfer();
                    selectedFiles.forEach(file => dt.items.add(file));
                    galleryInput.files = dt.files;
                };

                galleryInput.addEventListener('change', () => {
                    selectedFiles = Array.from(galleryInput.files);
                    renderPreview();
                });

                galleryPreview.addEventListener('click', event => {
                    const btn = event.target.closest('.remove-preview');
                    if (!btn) {
                        return;
                    }
                    const index = Number(btn.dataset.previewIndex);
                    if (Number.isNaN(index)) {
                        return;
                    }
                    selectedFiles.splice(index, 1);
                    syncInputFiles();
                    renderPreview();
                });
            }
        });

        // Handle removal button clicks
        document.addEventListener('click', function(event) {
            const button = event.target.closest('.toggle-existing');
            if (!button) {
                return;
            }

            event.preventDefault();
            event.stopPropagation();

            const id = button.dataset.id;
            const checkbox = document.getElementById('remove-img-' + id);
            const label = document.getElementById('label-' + id);
            const image = document.getElementById('img-' + id);

            console.log('Button clicked for image ID:', id);
            console.log('Checkbox element:', checkbox);
            console.log('Label element:', label);
            console.log('Image element:', image);

            if (!checkbox) {
                console.error('Checkbox not found for image ID:', id);
                return;
            }

            checkbox.checked = !checkbox.checked;

            if (checkbox.checked) {
                button.classList.add('bg-red-500', 'text-white');
                button.classList.remove('bg-white/85', 'text-gray-700');
                image?.classList.add('ring-4', 'ring-red-500', 'opacity-50');
                label?.classList.remove('hidden');
                console.log('✓ Marked image for removal:', id, 'Checkbox checked:', checkbox.checked);
            } else {
                button.classList.remove('bg-red-500', 'text-white');
                button.classList.add('bg-white/85', 'text-gray-700');
                image?.classList.remove('ring-4', 'ring-red-500', 'opacity-50');
                label?.classList.add('hidden');
                console.log('✗ Unmarked image:', id, 'Checkbox checked:', checkbox.checked);
            }
        });

        // Debug form submission
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                console.log('=== FORM SUBMISSION DEBUG ===');

                // Check all checkboxes for removal
                const removeCheckboxes = document.querySelectorAll('input[name="remove_gallery_images[]"]');
                const checkedIds = [];

                removeCheckboxes.forEach(cb => {
                    console.log('Checkbox ID:', cb.id, 'Value:', cb.value, 'Checked:', cb.checked);
                    if (cb.checked) {
                        checkedIds.push(cb.value);
                    }
                });

                console.log('Images marked for removal:', checkedIds);
                console.log('Total images to remove:', checkedIds.length);

                // Check new files
                const fileInput = document.getElementById('gallery_images');
                if (fileInput && fileInput.files.length > 0) {
                    console.log('New files to upload:', fileInput.files.length);
                    Array.from(fileInput.files).forEach((file, idx) => {
                        console.log(`File ${idx + 1}:`, file.name, file.size, 'bytes');
                    });
                } else {
                    console.log('No new files to upload');
                }

                console.log('=== END FORM DEBUG ===');

                // Allow form to submit
                // Uncomment below to prevent submission for testing
                // e.preventDefault();
            });
        }
    </script>
@endpush
