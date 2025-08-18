@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Scholarship</h1>
        <p class="text-gray-600 mt-2">Update scholarship information</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.scholarships.update', $scholarship) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="scholarship_name" class="block text-sm font-medium text-gray-700">Scholarship Name</label>
                <input type="text" name="scholarship_name" id="scholarship_name" value="{{ old('scholarship_name', $scholarship->scholarship_name) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="e.g., The John Doe Memorial Scholarship" required>
                @error('scholarship_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="award_amount" class="block text-sm font-medium text-gray-700">Award Amount</label>
                <input type="number" name="award_amount" id="award_amount" value="{{ old('award_amount', $scholarship->award_amount) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="5000" step="0.01" required>
                @error('award_amount')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                <input type="text" name="country" id="country" value="{{ old('country', $scholarship->country) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="e.g., United States" required>
                @error('country')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="eligibility_criteria" class="block text-sm font-medium text-gray-700">Eligibility Criteria</label>
                <textarea name="eligibility_criteria" id="eligibility_criteria" rows="3"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                          placeholder="e.g., Must be a high school senior with a minimum GPA of 3.5." required>{{ old('eligibility_criteria', $scholarship->eligibility_criteria) }}</textarea>
                @error('eligibility_criteria')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="application_description" class="block text-sm font-medium text-gray-700">Application Description</label>
                <textarea name="application_description" id="application_description" rows="3"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                          placeholder="Provide a detailed description for applicants." required>{{ old('application_description', $scholarship->application_description) }}</textarea>
                @error('application_description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="application_requirements" class="block text-sm font-medium text-gray-700">Application Requirements</label>
                <textarea name="application_requirements" id="application_requirements" rows="3"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                          placeholder="e.g., Transcripts, Personal Statement, Letters of Recommendation">{{ old('application_requirements', $scholarship->application_requirements) }}</textarea>
                @error('application_requirements')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="application_deadline" class="block text-sm font-medium text-gray-700">Application Deadline</label>
                <input type="date" name="application_deadline" id="application_deadline" value="{{ old('application_deadline', $scholarship->application_deadline) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                       required>
                @error('application_deadline')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.scholarships.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                    Update Scholarship
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
