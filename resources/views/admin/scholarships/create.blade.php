@extends('layouts.dashboard')
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('content')
    <div class="p-6 pt-5">
        <div class="space-y-4">
            <div class="space-y-6">
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
                            Scholarship Information
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">Enter the scholarship details, requirements, and
                            application
                            information</p>
                    </div>
                    <form action="{{ route('admin.scholarships.store') }}" method="POST" enctype="multipart/form-data"
                        class="p-6">
                        @csrf
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label for="scholarship_name"
                                        class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                            <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                            <path d="M2 17l10 5 10-5" />
                                            <path d="M2 12l10 5 10-5" />
                                        </svg>
                                        Scholarship Name
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="scholarship_name" id="scholarship_name"
                                            value="{{ old('scholarship_name') }}"
                                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                            placeholder="{{ __('Please Enter the Scholarship Name') }}" required>
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
                                        <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
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
                                        Status
                                    </label>
                                    <div class="relative">
                                        <select name="status" id="status"
                                            class="block w-full pl-10 pr-8 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                            required>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                            {{-- <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed --}}
                                            </option>
                                        </select>
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="text-gray-400">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M9 12l2 2 4-4" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('status')
                                        <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


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
                                        Award Amount
                                    </label>
                                    <div class="relative">
                                        <input type="number" name="award_amount" id="award_amount"
                                            value="{{ old('award_amount') }}"
                                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                            placeholder="{{ __('Enter the Award Amount') }}" step="0.01" required>
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="text-gray-400">
                                                <line x1="12" y1="1" x2="12" y2="23" />
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('award_amount')
                                        <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            {{ $message }}
                                        </div>
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
                                        Country
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="country" id="country"
                                            value="{{ old('country') }}"
                                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                            placeholder="e.g., United States" required>
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="text-gray-400">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M8 12h8" />
                                                <path d="M12 8v8" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('country')
                                        <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="group">
                                    <label for="application_deadline"
                                        class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                            <rect width="18" height="18" x="3" y="4" rx="2"
                                                ry="2" />
                                            <line x1="16" y1="2" x2="16" y2="6" />
                                            <line x1="8" y1="2" x2="8" y2="6" />
                                            <line x1="3" y1="10" x2="21" y2="10" />
                                        </svg>
                                        Application Deadline
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="application_deadline" id="application_deadline"
                                            value="{{ old('application_deadline') }}"
                                            class="date-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                            required>
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="text-gray-400">
                                                <rect width="18" height="18" x="3" y="4" rx="2"
                                                    ry="2" />
                                                <line x1="16" y1="2" x2="16" y2="6" />
                                                <line x1="8" y1="2" x2="8" y2="6" />
                                                <line x1="3" y1="10" x2="21" y2="10" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('application_deadline')
                                        <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="group">
                                <label for="eligibility_criteria"
                                    class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                        <path d="M22 4L12 14.01l-3-3" />
                                    </svg>
                                    Eligibility Criteria
                                </label>
                                <div class="relative">
                                    <textarea name="eligibility_criteria" id="eligibility_criteria" rows="4"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                        placeholder="e.g., Must be a high school senior with a minimum GPA of 3.5." required>{{ old('eligibility_criteria') }}</textarea>
                                    <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 mt-0.5">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                            <path d="M22 4L12 14.01l-3-3" />
                                        </svg>
                                    </div>
                                </div>
                                @error('eligibility_criteria')
                                    <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="15" y1="9" x2="9" y2="15" />
                                            <line x1="9" y1="9" x2="15" y2="15" />
                                        </svg>
                                        {{ $message }}
                                    </div>
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
                                    Application Description
                                </label>
                                <div class="relative">
                                    <textarea name="application_description" id="application_description" rows="4"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                        placeholder="Provide a detailed description for applicants." required>{{ old('application_description') }}</textarea>
                                    <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 mt-0.5">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                            <path d="M14 2v6h6" />
                                            <line x1="16" y1="13" x2="8" y2="13" />
                                            <line x1="16" y1="17" x2="8" y2="17" />
                                            <line x1="10" y1="9" x2="8" y2="9" />
                                        </svg>
                                    </div>
                                </div>
                                @error('application_description')
                                    <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="15" y1="9" x2="9" y2="15" />
                                            <line x1="9" y1="9" x2="15" y2="15" />
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                                <div class="group">
                                    <label for="application_requirements"
                                        class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                            <path d="M9 12l2 2 4-4" />
                                            <path d="M21 12c-1 0-3-1-3-3s2-3 3-3 3 1 3 3-2 3-3 3" />
                                            <path d="M3 12c1 0 3-1 3-3s-2-3-3-3-3 1-3 3 2 3 3 3" />
                                            <path d="M3 12v6a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-6" />
                                        </svg>
                                        Application Requirements
                                    </label>
                                    <div class="bg-gray-50 rounded-lg border">
                                        <div id="requirements-container" class="space-y-3">
                                            <div
                                                class="requirement-item flex items-stretch rounded-lg border border-gray-300 shadow-sm overflow-hidden bg-white">
                                                <div class="relative flex-1">
                                                    <input type="text" name="application_requirements[]"
                                                        class="block w-full pl-10 pr-3 py-3 border-0 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
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
                                                <button type="button" id="add-requirement"
                                                    class="add-requirement flex items-center justify-center w-14 bg-blue-500 hover:bg-blue-600 text-white transition-colors duration-200"
                                                    aria-label="Add requirement">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M5 12h14" />
                                                        <path d="M12 5v14" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('application_requirements')
                                        <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="group">
                                    <label for="gallery_images"
                                        class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                            <rect x="3" y="3" width="18" height="18" rx="2"
                                                ry="2" />
                                            <circle cx="8.5" cy="8.5" r="1.5" />
                                            <polyline points="21 15 16 10 5 21" />
                                        </svg>
                                        Scholarship Gallery Images
                                    </label>
                                    <input type="file" id="gallery_images" name="gallery_images[]"
                                        accept="image/jpeg,image/png,image/jpg" multiple max="10"
                                        class="block w-full text-gray-700 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700">
                                    <p class="text-xs text-gray-500 mt-1">You may upload up to 10 images (JPG, JPEG,
                                        PNG,
                                        2MB each).</p>
                                    <div id="gallery-preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 hidden">
                                    </div>
                                    @error('gallery_images')
                                        <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200 mt-8">
                            <a href="{{ route('admin.scholarships.index') }}"
                                class="inline-flex items-center justify-center gap-2 px-6 py-3 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18" />
                                    <path d="M6 6l12 12" />
                                </svg>
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>
                                Create Scholarship
                            </button>
                        </div>
                    </form>
                </div>
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
                    const newItem = document.createElement('div');
                    newItem.className =
                        'requirement-item flex items-stretch rounded-lg border border-gray-300 shadow-sm overflow-hidden bg-white';
                    newItem.innerHTML = `
                        <div class="relative flex-1">
                            <input type="text" name="application_requirements[]"
                                class="block w-full pl-10 pr-3 py-3 border-0 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                placeholder="e.g., Personal Statement" required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-gray-400">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <path d="M14 2v6h6" />
                                    <line x1="16" y1="13" x2="8" y2="13" />
                                    <line x1="16" y1="17" x2="8" y2="17" />
                                    <line x1="10" y1="9" x2="8" y2="9" />
                                </svg>
                            </div>
                        </div>
                        <button type="button"
                            class="remove-requirement flex items-center justify-center w-14 bg-red-500 hover:bg-red-600 text-white transition-colors duration-200"
                            aria-label="Remove requirement">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M5 12h14" />
                            </svg>
                        </button>
                    `;
                    return newItem;
                };

                addButton.addEventListener('click', () => {
                    const newItem = createRequirementItem();
                    container.appendChild(newItem);
                    newItem.querySelector('input')?.focus();
                });

                container.addEventListener('click', event => {
                    const removeBtn = event.target.closest('.remove-requirement');
                    if (!removeBtn) {
                        return;
                    }

                    const targetItem = removeBtn.closest('.requirement-item');
                    if (targetItem) {
                        targetItem.remove();
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
    </script>
@endpush
