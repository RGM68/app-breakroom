<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breakroom Billiards</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <style>
        .video-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .video-background {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            object-fit: cover;
        }

        .scroll-down {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0) translateX(-50%);
            }
            40% {
                transform: translateY(-30px) translateX(-50%);
            }
            60% {
                transform: translateY(-15px) translateX(-50%);
            }
        }

        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        @media (max-width: 768px) {
            .video-background {
                height: 100vh;
                width: auto;
            }

            .button-container {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <!-- Hero Section -->
    <div class="relative h-screen">
        <div class="video-container">
            <video autoplay muted loop playsinline class="video-background">
                <source src="{{ asset('videos/index.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>
        <div class="relative z-20 flex flex-col items-center justify-center h-full text-white px-4">
            <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold mb-4 text-center" data-aos="fade-down">Welcome to Breakroom</h1>
            <p class="text-xl md:text-2xl mb-8 text-center max-w-2xl" data-aos="fade-up" data-aos-delay="200">Where Passion Meets Precision</p>
            <div class="button-container flex space-x-4 md:space-x-6" data-aos="fade-up" data-aos-delay="400">
                @if (true)
                    <a href="{{ route('login') }}" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-lg font-semibold text-center transition-all duration-300 transform hover:scale-105">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="w-full md:w-auto bg-transparent border-2 border-white hover:bg-white hover:text-black px-8 py-4 rounded-lg font-semibold text-center transition-all duration-300 transform hover:scale-105">
                        Sign Up
                    </a>
                @endif
            </div>
        </div>
        <div class="scroll-down text-white text-center">
            <p class="mb-2">Discover More</p>
            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>

    <!-- About Section -->
    <div class="py-20 px-4 bg-gray-100">
        <div class="max-w-6xl mx-auto" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-center mb-16">Experience Excellence</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center p-6 bg-white rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105">
                    <div class="w-20 h-20 mx-auto mb-4 bg-blue-600 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Premium Tables</h3>
                    <p>Experience the game on our professional-grade tables, maintained to perfection for optimal play.</p>
                </div>
                <div class="text-center p-6 bg-white rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105">
                    <div class="w-20 h-20 mx-auto mb-4 bg-blue-600 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Events & Tournaments</h3>
                    <p>Join our regular tournaments and special events designed for players of all skill levels.</p>
                </div>
                <div class="text-center p-6 bg-white rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105">
                    <div class="w-20 h-20 mx-auto mb-4 bg-blue-600 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Food & Drinks</h3>
                    <p>Enjoy our extensive menu of refreshments and gourmet snacks while you play.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Parallax Section -->
    <div class="parallax h-96 relative flex items-center justify-center" style="background-image: url('{{ asset('../photos/breakroom.png') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10 text-center text-white" data-aos="fade-up">
            <h2 class="text-4xl font-bold mb-4">Join Our Community</h2>
            <p class="text-xl mb-8">Experience the thrill of billiards in a premium setting</p>
            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-lg font-semibold inline-block transition-all duration-300 transform hover:scale-105">
                Get Started Today
            </a>
        </div>
    </div>

    <!-- Location Section -->
    <div class="py-20 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center mb-16" data-aos="fade-up">Find Us</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="h-96 rounded-lg overflow-hidden shadow-lg" data-aos="fade-right">
                    <!-- Replace YOUR_GOOGLE_MAPS_API_KEY and coordinates with actual values -->
                    <iframe
                        width="100%"
                        height="100%"
                        frameborder="0"
                        style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?key=YOUR_GOOGLE_MAPS_API_KEY&q=123+Billiard+Street,City,State+12345"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="p-8 bg-gray-100 rounded-lg" data-aos="fade-left">
                    <h3 class="text-2xl font-bold mb-6">Contact Information</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p>Jl. Scientia Square Utara, Curug Sangereng, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15810</p>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <p>0813-1999-0246</p>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <p>info@breakroom.com</p>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p>Monday - Sunday: 10:00 AM - 00:00 AM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <h4 class="text-2xl font-bold mb-6">Breakroom</h4>
                    <p class="mb-4">Experience premium billiards in a sophisticated atmosphere. Join us for an unforgettable gaming experience.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-blue-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-blue-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-blue-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-2xl font-bold mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-blue-400 transition-colors duration-300">About Us</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors duration-300">Events</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors duration-300">Membership</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors duration-300">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-2xl font-bold mb-6">Newsletter</h4>
                    <p class="mb-4">Subscribe to our newsletter for updates and exclusive offers.</p>
                    <form class="flex gap-2">
                        <input type="email" placeholder="Enter your email" class="px-4 py-2 rounded-lg flex-grow text-gray-900">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-lg font-semibold transition-colors duration-300">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-12 pt-8 text-center">
                <p>&copy; 2024 Breakroom. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Initialize AOS (Animate On Scroll)
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100
            });
        });

        // Smooth scroll functionality
        document.querySelector('.scroll-down').addEventListener('click', function(e) {
            e.preventDefault();
            const nextSection = document.querySelector('.py-20');
            nextSection.scrollIntoView({ behavior: 'smooth' });
        });
    </script>
</body>
</html>