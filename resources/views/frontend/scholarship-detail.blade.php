@extends('layouts.homepage')
@section('content')
    <div class="bg-gray-50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $scholarship->scholarship_name }}</h1>
                <p class="text-gray-600 mt-2">Explore details and application information</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Basic Information</h2>
                        </div>
                        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <div class="text-sm font-medium text-gray-700 mb-2">Award Amount</div>
                                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                    <p class="text-2xl font-bold text-green-800">${{ $scholarship->award_amount }}</p>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-700 mb-2">Country</div>
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                    <p class="text-lg font-semibold text-blue-800">{{ $scholarship->country }}</p>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-700 mb-2">Status</div>
                                <div class="rounded-lg p-3 border"
                                     @class([
                                        'bg-green-50 border-green-200' => $scholarship->status === 'active',
                                        'bg-yellow-50 border-yellow-200' => $scholarship->status === 'inactive',
                                        'bg-red-50 border-red-200' => ! in_array($scholarship->status, ['active','inactive'])
                                     ])>
                                    <p class="text-lg font-semibold capitalize"
                                       @class([
                                          'text-green-800' => $scholarship->status === 'active',
                                          'text-yellow-800' => $scholarship->status === 'inactive',
                                          'text-red-800' => ! in_array($scholarship->status, ['active','inactive'])
                                       ])>
                                        {{ $scholarship->status }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mt-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Gallery</h2>
                        </div>
                        <div class="p-6">
                            @if($scholarship->images->count())
                                <div class="flex gap-3 overflow-x-auto pb-3">
                                    @foreach($scholarship->images as $img)
                                        <img src="{{ asset('storage/' . $img->image_path) }}" class="rounded-lg h-40 object-cover shadow-md" alt="Scholarship Image">
                                    @endforeach
                                </div>
                            @else
                                <div class="text-gray-500 italic">No gallery images uploaded for this scholarship yet.</div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Application Details</h2>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <div class="text-sm font-medium text-gray-700 mb-2">Eligibility Criteria</div>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <p class="text-gray-800 leading-relaxed">{{ $scholarship->eligibility_criteria }}</p>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-700 mb-2">Application Description</div>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <p class="text-gray-800 leading-relaxed">{{ $scholarship->application_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Requirements</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                @foreach ($scholarship->application_requirements as $requirement)
                                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                        <span class="text-gray-800 font-medium">{{ $requirement }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Application Deadline</h2>
                        </div>
                        <div class="p-6">
                            <div class="text-center">
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                    <p class="text-2xl font-bold text-red-800">{{ \Carbon\Carbon::parse($scholarship->application_deadline)->format('M d, Y') }}</p>
                                    <p class="text-sm text-red-600 mt-1">
                                        @php
                                            $deadline = \Carbon\Carbon::parse($scholarship->application_deadline);
                                            $now = \Carbon\Carbon::now();
                                            $daysLeft = $now->diffInDays($deadline, false);
                                        @endphp
                                        @if ($daysLeft > 0)
                                            {{ $daysLeft }} days remaining
                                        @elseif($daysLeft == 0)
                                            Deadline is today!
                                        @else
                                            Deadline passed {{ abs($daysLeft) }} days ago
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 space-y-3">
                            @auth
                                <form action="{{ route('scholarships.apply', $scholarship) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="motivation_essay" class="block font-medium text-gray-700">Motivation / Statement of Purpose</label>
                                        <textarea id="motivation_essay" name="motivation_essay" class="w-full border rounded p-2" rows="4" required>{{ old('motivation_essay') }}</textarea>
                                    </div>
                                    <div>
                                        <label for="resume" class="block font-medium text-gray-700">Resume (PDF, DOC, DOCX; optional)</label>
                                        <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx" class="w-full border rounded p-2">
                                    </div>
                                    <div>
                                        <label for="phone" class="block font-medium text-gray-700">Phone Number</label>
                                        <input type="text" name="phone" id="phone" class="w-full border rounded p-2" value="{{ old('phone') }}" required>
                                    </div>
                                    <div>
                                        <label for="address" class="block font-medium text-gray-700">Address</label>
                                        <textarea name="address" id="address" class="w-full border rounded p-2" required>{{ old('address') }}</textarea>
                                    </div>
                                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 font-medium">Apply Now</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 font-medium">Please login to apply</a>
                            @endauth
                            <a href="{{ route('scholarships.index') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 font-medium">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
