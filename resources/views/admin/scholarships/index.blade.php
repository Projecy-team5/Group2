@extends('layouts.dashboard')

@section('title', 'Scholarships List')

@section('content')
    <div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-xl p-6 sm:p-8 lg:p-10">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6 text-center">
            Scholarships List
        </h1>

        @if (session('success'))
            <div class="mt-4 p-4 rounded-md bg-green-50 text-green-700 flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('admin.scholarships.create') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700">
                Create New Scholarship
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-md">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Award Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($scholarships as $scholarship)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $scholarship->scholarship_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $scholarship->award_amount }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $scholarship->country }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $scholarship->application_deadline}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                <a href="{{ route('admin.scholarships.show', $scholarship) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                <a href="{{ route('admin.scholarships.edit', $scholarship) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                <form action="{{ route('admin.scholarships.destroy', $scholarship) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this scholarship?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No scholarships found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
