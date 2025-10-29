@extends('layouts.dashboard')

@section('title', 'Applications')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Submitted Scholarship Applications</h1>
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Applicant</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Phone</th>
                    <th class="px-4 py-2">Scholarship</th>
                    <th class="px-4 py-2">Essay</th>
                    <th class="px-4 py-2">Resume</th>
                    <th class="px-4 py-2">Submitted At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $application->user->name }}</td>
                        <td class="px-4 py-2">{{ $application->user->email }}</td>
                        <td class="px-4 py-2">{{ $application->phone }}</td>
                        <td class="px-4 py-2">{{ $application->scholarship->scholarship_name }}</td>
                        <td class="px-4 py-2 max-w-xs"><div class="truncate">{{ Str::limit($application->motivation_essay, 40) }}</div></td>
                        <td class="px-4 py-2">
                            @if($application->resume)
                                <a href="{{ asset('storage/'.$application->resume) }}" class="text-indigo-600 hover:underline" target="_blank">View Resume</a>
                            @else
                                None
                            @endif
                        </td>
                        <td class="px-4 py-2 text-xs">{{ $application->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-4 py-2 text-center text-gray-500">No applications yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $applications->links() }}</div>
    </div>
</div>
@endsection
