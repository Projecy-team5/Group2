@extends('layouts.dashboard')

@section('title', 'Scholarship Details')

@section('content')
    <div class="w-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl p-6 sm:p-8 lg:p-10">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6 text-center">
            {{ $scholarship->scholarship_name }}
        </h1>

        <div class="space-y-6">
            <div>
                <h2 class="text-lg font-medium text-gray-700">Award Amount</h2>
                <p class="mt-1 text-gray-900">{{ $scholarship->award_amount }}</p>
            </div>

            <div>
                <h2 class="text-lg font-medium text-gray-700">Country</h2>
                <p class="mt-1 text-gray-900">{{ $scholarship->country }}</p>
            </div>

            <div>
                <h2 class="text-lg font-medium text-gray-700">Eligibility Criteria</h2>
                <p class="mt-1 text-gray-900">{{ $scholarship->eligibility_criteria }}</p>
            </div>

            <div>
                <h2 class="text-lg font-medium text-gray-700">Application Description</h2>
                <p class="mt-1 text-gray-900">{{ $scholarship->application_description }}</p>
            </div>

            <div>
                <h2 class="text-lg font-medium text-gray-700">Application Requirements</h2>
                <ul class="mt-1 list-disc list-inside text-gray-900">
                    @foreach ($scholarship->application_requirements as $requirement)
                        <li>{{ $requirement }}</li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h2 class="text-lg font-medium text-gray-700">Application Deadline</h2>
                <p class="mt-1 text-gray-900">{{ $scholarship->application_deadline }}</p>
            </div>

            <div class="flex justify-center space-x-4 pt-4">
                <a href="{{ route('admin.scholarships.index') }}" class="px-6 py-3 bg-gray-600 text-white font-medium rounded-md hover:bg-gray-700">
                    Back to List
                </a>
                <a href="{{ route('admin.scholarships.edit', $scholarship) }}" class="px-6 py-3 bg-yellow-600 text-white font-medium rounded-md hover:bg-yellow-700">
                    Edit Scholarship
                </a>
            </div>
        </div>
    </div>
@endsection
