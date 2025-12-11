@extends('layouts.homepage')
@section('content')


    <div class="bg-gray-50 min-h-screen py-12 px-4">
        <div class="max-w-7xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900">{{ $scholarship->scholarship_name }}</h1>
                <p class="mt-2 text-lg text-gray-600">{{ $scholarship->country }} • Scholarship</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Basic Info -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                            <p class="text-sm text-gray-600">Award Amount</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">${{ number_format($scholarship->award_amount) }}</p>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                            <p class="text-sm text-gray-600">Country</p>
                            <p class="text-2xl font-semibold text-gray-900 mt-1">{{ $scholarship->country }}</p>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                            <p class="text-sm text-gray-600">Deadline</p>
                            <p class="text-xl font-bold text-gray-900 mt-1">
                                {{ \Carbon\Carbon::parse($scholarship->application_deadline)->format('d M Y') }}
                            </p>
                            @php
                                $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($scholarship->application_deadline), false);
                            @endphp
                            <p class="text-sm mt-2 @if($daysLeft <= 7) text-red-600 font-medium @else text-gray-500 @endif">
                                {{-- @if($daysLeft > 0) {{ $daysLeft }} days left
                                @elseif($daysLeft == 0) Closes today
                                @else Expired @endif --}}
                            </p>
                        </div>
                    </div>

                    <!-- Gallery Slider -->
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Gallery</h2>
                        </div>
                        <div class="p-6">
                            @if($scholarship->images->count())
                                <div class="swiper gallerySlider">
                                    <div class="swiper-wrapper">
                                        @foreach($scholarship->images as $img)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $img->image_path) }}"
                                                     class="w-full h-80 object-cover rounded-lg shadow-sm"
                                                     alt="Scholarship image">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            @else
                                <p class="text-center text-gray-500 py-12">No images available</p>
                            @endif
                        </div>
                    </div>

                    <!-- Descriptions -->
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Eligibility Criteria</h3>
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $scholarship->eligibility_criteria }}</p>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Application Guidelines</h3>
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $scholarship->application_description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">

                    <!-- Requirements -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Required Documents</h3>
                        <ul class="space-y-3">
                            @foreach($scholarship->application_requirements as $req)
                                <li class="flex items-start gap-3">
                                    <span class="text-indigo-600 mt-1">•</span>
                                    <span class="text-gray-700">{{ $req }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Apply Button + Popup Modal -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                        @auth
                            <button type="button" onclick="document.getElementById('applyModal').showModal()"
                                    class="w-full bg-indigo-600 text-white font-medium py-4 rounded-md hover:bg-indigo-700 transition text-lg">
                                Apply Now
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-indigo-600 text-white font-medium py-4 rounded-md hover:bg-indigo-700 transition text-lg text-center">
                                Login to Apply
                            </a>
                        @endauth

                        <div class="mt-6">
                            <a href="{{ route('scholarships.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">
                                ← Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Apply Popup Modal (Native <dialog> - no extra JS needed) -->
    @auth
    <dialog id="applyModal" class="w-full max-w-2xl p-8 bg-white rounded-xl shadow-2xl border border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-900">Apply for Scholarship</h3>
            <button onclick="document.getElementById('applyModal').close()" class="text-gray-500 hover:text-gray-900 text-2xl">
                ✕
            </button>
        </div>

        <form action="{{ route('scholarships.apply', $scholarship) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Motivation Essay / Statement</label>
                <textarea name="motivation_essay" rows="7" required class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Resume / CV (Optional)</label>
                <input type="file" name="resume" accept=".pdf,.doc,.docx" class="w-full border border-gray-300 rounded-md px-4 py-3">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="text" name="phone" required class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Address</label>
                <textarea name="address" rows="3" required class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-indigo-600 text-white font-medium py-3 rounded-md hover:bg-indigo-700 transition">
                    Submit Application
                </button>
                <button type="button" onclick="document.getElementById('applyModal').close()" class="flex-1 border border-gray-300 text-gray-700 font-medium py-3 rounded-md hover:bg-gray-50">
                    Cancel
                </button>
            </div>
        </form>
    </dialog>
    @endauth

@endsection
