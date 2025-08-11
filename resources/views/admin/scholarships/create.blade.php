@extends('layouts.dashboard')

@section('title', 'Create New Scholarship')

@section('content')
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-xl p-6 sm:p-8 lg:p-10 h-auto">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6 text-center">
            Create New Scholarship
        </h1>

        @if (session('success'))
            <div id="success-message" class="mt-4 p-4 rounded-md bg-green-50 text-green-700 flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.scholarships.store') }}" method="POST" class="space-y-6  w-auto h-auto">
            @csrf

            <div>
                <label for="scholarship_name" class="block text-sm font-medium text-gray-700 mb-1">Scholarship Name</label>
                <input
                    type="text"
                    id="scholarship_name"
                    name="scholarship_name"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="e.g., The John Doe Memorial Scholarship"
                    value="{{ old('scholarship_name') }}"
                    required
                >
                @error('scholarship_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="award_amount" class="block text-sm font-medium text-gray-700 mb-1">Award Amount</label>
                <input
                    type="text"
                    id="award_amount"
                    name="award_amount"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="e.g., $5,000"
                    value="{{ old('award_amount') }}"
                    required
                >
                @error('award_amount')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <input
                    type="text"
                    id="country"
                    name="country"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="e.g., United States"
                    value="{{ old('country') }}"
                    required
                >
                @error('country')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="eligibility_criteria" class="block text-sm font-medium text-gray-700 mb-1">Eligibility Criteria</label>
                <textarea
                    id="eligibility_criteria"
                    name="eligibility_criteria"
                    rows="3"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="e.g., Must be a high school senior with a minimum GPA of 3.5."
                    required
                >{{ old('eligibility_criteria') }}</textarea>
                @error('eligibility_criteria')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="application_description" class="block text-sm font-medium text-gray-700 mb-1">Application Description</label>
                <textarea
                    id="application_description"
                    name="application_description"
                    rows="3"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Provide a detailed description for applicants."
                    required
                >{{ old('application_description') }}</textarea>
                @error('application_description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div x-data='{
                requirements: @json(is_array(old('application_requirements')) ? old('application_requirements') : ['Transcripts', 'Personal Statement']),
                newRequirement: ""
            }'>
                <label class="block text-sm font-medium text-gray-700 mb-1">Application Requirements</label>
                <div class="mt-1 space-y-2">
                    <template x-for="(req, index) in requirements" :key="index">
                        <div class="flex items-center justify-between p-2 bg-gray-50 border border-gray-200 rounded-md">
                            <span class="text-gray-800" x-text="req"></span>
                            <input type="hidden" :name="'application_requirements[]'" :value="req">
                            <button
                                type="button"
                                @click="requirements.splice(index, 1)"
                                class="text-red-500 hover:text-red-700"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
                <div class="mt-2 flex">
                    <input
                        type="text"
                        x-model="newRequirement"
                        @keydown.enter.prevent="if (newRequirement.trim() !== '') { requirements.push(newRequirement.trim()); newRequirement = '' }"
                        class="flex-grow px-4 py-2 border border-gray-300 rounded-l-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Add a new requirement"
                    >
                    <button
                        type="button"
                        @click="if (newRequirement.trim() !== '') { requirements.push(newRequirement.trim()); newRequirement = '' }"
                        class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-r-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Add
                    </button>
                </div>
                @error('application_requirements')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="application_deadline" class="block text-sm font-medium text-gray-700 mb-1">Application Deadline</label>
                <input
                    type="date"
                    id="application_deadline"
                    name="application_deadline"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    value="{{ old('application_deadline') }}"
                    required
                >
                @error('application_deadline')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center pt-4">
                <button
                    type="submit"
                    class="w-full md:w-auto flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Save Scholarship
                </button>
            </div>
        </form>
    </div>
@endsection
