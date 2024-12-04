<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breakroom Billiards</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
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

<body>
    <div class="relative h-screen">
        <div class="video-container">
            <video autoplay muted loop playsinline class="video-background">
                <source src="{{ asset('videos/index.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>
        <div class="relative z-20 flex flex-col items-center justify-center h-full text-white px-4">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 text-center">Welcome to Breakroom</h1>
            <p class="text-lg md:text-xl mb-8 text-center max-w-2xl">Experience premium billiards in a sophisticated
                atmosphere</p>
            <div class="button-container flex space-x-4 md:space-x-6">
                @auth
                    <a href="{{ route('bookings.check') }}"
                        class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg font-semibold text-center">Book
                        a Table</a>
                @else
                    <a href="{{ route('login') }}"
                        class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg font-semibold text-center">Login</a>
                    <a href="{{ route('register') }}"
                        class="w-full md:w-auto bg-transparent border-2 border-white hover:bg-white hover:text-black px-6 py-3 rounded-lg font-semibold text-center">Sign
                        Up</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16 px-4">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <h3 class="text-xl font-bold mb-2">Premium Tables</h3>
                <p>Professional-grade billiards tables maintained to perfection</p>
            </div>
            <div class="text-center">
                <h3 class="text-xl font-bold mb-2">Events & Tournaments</h3>
                <p>Regular tournaments and special events for all skill levels</p>
            </div>
            <div class="text-center">
                <h3 class="text-xl font-bold mb-2">Food & Drinks</h3>
                <p>Extensive menu of refreshments and snacks while you play</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h4 class="font-bold mb-4">Opening Hours</h4>
                <p>Monday - Sunday: 10:00 AM - 2:00 AM</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Contact</h4>
                <p>Email: info@breakroom.com</p>
                <p>Phone: (555) 123-4567</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Location</h4>
                <p>123 Billiard Street</p>
                <p>City, State 12345</p>
            </div>
        </div>
    </footer>
</body>

</html>