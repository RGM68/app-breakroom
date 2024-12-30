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
            <h1 class="text-2xl font-bold">Breakroom</h1>
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
                    <li><a href="{{ route('dashboard') }}"
                            class="block px-4 py-2 rounded-md hover:text-yellow-400 {{ Request::is('dashboard') ? 'bg-slate-500 text-yellow-400 font-bold' : 'text-white hover:text-yellow-400' }}">Home</a>
                    </li>
                    <li><a href="{{ route('user.tables') }}"
                            class="block px-4 py-2 rounded-md  hover:text-yellow-400">Meja</a>
                    </li>
                    <!-- Masih Blom Fix -->
                    <li><a href="#" class="block px-4 py-2 rounded-md  hover:text-yellow-400">Event</a></li>
                    <li><a href="{{route('user.profile')}}" class="block px-4 py-2 rounded-md  hover:text-yellow-400">Profile</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded-md  hover:text-yellow-400">Products</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded-md  hover:text-yellow-400">Foods</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded-md  hover:text-yellow-400">Booking History</a>
                    </li>
                    <li><a href="#" class="block px-4 py-2 rounded-md  hover:text-yellow-400">Loyalty Program</a>
                    </li>
                </ul>
            </aside>

            {{-- <main class="flex-1 p-8">
                <h2 class="text-3xl font-bold text-yellow-400 mb-6">Available Tables</h2>

                <!-- Tables List -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($tables as $table)
                        <div class=" p-6 rounded-lg shadow-lg hover:opacity-85 hover:scale-[1.02] {{ strtolower($table->status) == "closed" ? 'bg-[#1a1d4d] opacity-70' : 'bg-indigo-700'}}">
                            <h3 class="text-xl font-semibold text-white mb-4">Table #{{ $table->id }}</h3>
                            <p class="text-white mb-4">Status:
                                <span class="{{ strtolower($table->status) == "open" ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $table->status }}
                                </span>
                            </p>
                            <p class="text-white">Capacity: {{ $table->capacity }} people</p>
                        </div>
                    @endforeach
                </div>
            </main> --}}

            <main class="flex-1 p-8">
                <h2 class="text-3xl font-bold text-yellow-400 mb-6">Available Tables</h2>

                <!-- Tables List -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($tables as $table)
                        <div
                            class=" p-6 rounded-lg shadow-lg hover:opacity-85 hover:scale-[1.02] {{ strtolower($table->status) == 'closed' ? 'bg-[#1a1d4d] opacity-70' : 'bg-indigo-700' }}">
                            <h3 class="text-xl font-semibold text-white mb-4">Table #{{ $table->id }}</h3>
                            <p class="text-white mb-4">Status:
                                <span
                                    class="{{ strtolower($table->status) == 'open' ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $table->status }}
                                </span>
                            </p>
                            <p class="text-white">Capacity: {{ $table->capacity }} people</p>
                        </div>
                    @endforeach
                </div>

                <!-- Show more tables button -->
                @if (count($tables))
                    <div class="mt-6 text-center">
                        <a href="{{ route('user.tables') }}" class="text-yellow-400 underline hover:text-yellow-500">See
                            more details</a>
                    </div>
                @endif
            </main>
</body>


</html>
