<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScholarshipHub - Your Gateway to Educational Funding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="bg-gray-50">
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-gradient">ScholarshipHub</h1>
                    </div>
                    <div class="hidden md:block ml-10">
                        <div class="flex space-x-8">
                            <a href="#"
                                class="text-gray-900 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Home</a>
                            <a href="#"
                                class="text-gray-500 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Scholarships</a>
                            <a href="#"
                                class="text-gray-500 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">About</a>
                            <a href="#"
                                class="text-gray-500 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Resources</a>
                            <a href="#"
                                class="text-gray-500 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Contact</a>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}"
                        class="text-gray-500 hover:text-indigo-600 px-4 py-2 text-sm font-medium border border-transparent hover:border-gray-300 rounded-lg transition-all">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-indigo-600 text-white px-4 py-2 text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">Sign
                        Up</a>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="col-span-1">
                    <h3 class="text-2xl font-bold text-gradient mb-4">ScholarshipHub</h3>
                    <p class="text-gray-400">Empowering students to achieve their educational dreams through accessible
                        funding opportunities.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Platform</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Find Scholarships</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Application Tracker</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Essay Assistant</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Deadlines</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Guides</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">FAQs</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Success Stories</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2025 ScholarshipHub. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
