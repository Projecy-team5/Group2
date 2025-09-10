@extends('layouts.homepage')
@section('content')

    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-4">Scholarship Program 2025</h1>
            <p class="text-xl mb-8">Empowering the next generation of leaders with opportunities to excel.</p>
            <a href="#apply" class="bg-yellow-500 text-white px-6 py-3 rounded-full font-semibold hover:bg-yellow-600 transition duration-300">Apply Now</a>
        </div>
    </div>

    <!-- Scholarship Details -->
    <div class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">About Our Scholarship</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Financial Support</h3>
                    <p class="text-gray-600">Up to $10,000 per year to cover tuition, books, and living expenses.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Mentorship Program</h3>
                    <p class="text-gray-600">Personalized guidance from industry leaders to help you succeed.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Career Opportunities</h3>
                    <p class="text-gray-600">Access to internships and networking events with top companies.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Eligibility Criteria -->
    <div class="bg-gray-200 py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Eligibility Criteria</h2>
            <ul class="list-disc list-inside text-gray-600 max-w-2xl mx-auto">
                <li class="mb-4">Must be enrolled in an accredited university or college.</li>
                <li class="mb-4">Minimum GPA of 3.0 on a 4.0 scale.</li>
                <li class="mb-4">Demonstrated leadership and community involvement.</li>
                <li class="mb-4">Submission of a 500-word essay on your career goals.</li>
            </ul>
        </div>
    </div>

    <!-- Application Form -->
    <div id="apply" class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Apply for the Scholarship</h2>
            <form action="" method="POST" class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Full Name</label>
                    <input type="text" id="name" name="name" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                    <input type="email" id="email" name="email" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-6">
                    <label for="gpa" class="block text-gray-700 font-semibold mb-2">Current GPA</label>
                    <input type="number" id="gpa" name="gpa" step="0.1" min="0" max="4" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-6">
                    <label for="essay" class="block text-gray-700 font-semibold mb-2">Essay (500 words)</label>
                    <textarea id="essay" name="essay" rows="6" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">Submit Application</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2025 Scholarship Program. All rights reserved.</p>
        </div>
    </div>
@endsection
