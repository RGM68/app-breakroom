<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-gray-800 p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">User Dashboard</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-600 px-4 py-2 rounded hover:bg-red-700" type="submit">Logout</button>
            </form>
        </nav>
        
        <!-- Main Content -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="w-1/4 bg-gray-700 p-4">
                <ul class="space-y-4">
                    <li><a href="{{ route('dashboard') }}" class="block hover:text-yellow-400">Home</a></li>
                    <li><a href="{{ route('dashboard') }}" class="block hover:text-yellow-400">Booking Meja</a></li> <!-- Masih Blom Fix -->
                    <li><a href="{{ route('event.index') }}" class="block hover:text-yellow-400">Event</a></li> 
                    <li><a href="{{ route('profile.index') }}" class="block hover:text-yellow-400">Profile</a></li>
                    <li><a href="{{ route('products.index') }}" class="block hover:text-yellow-400">Products</a></li>
                    <li><a href="{{ route('food-and-drinks.index') }}" class="block hover:text-yellow-400">Foods</a></li>
                    <li><a href="{{ route('booking-history.index') }}" class="block hover:text-yellow-400">Booking History</a></li>
                    <li><a href="{{ route('loyalty-program.index') }}" class="block hover:text-yellow-400">Loyalty Program</a></li>
                </ul>
            </aside>

            <!-- Main Dashboard Content -->
            <main class="flex-1 p-8">
                <h2 class="text-3xl font-bold mb-4">Welcome, {{ Auth::user()->name }}</h2>
                <p class="text-gray-300">Ayo mulai eksplorasi fitur-fitur dashboard kamu!</p>
            </main>
        </div>
    </div>
</body>


</html>