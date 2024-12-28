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
                            class="block px-4 py-2 rounded-md hover:text-yellow-400 }}">Home</a>
                    </li>
                    <li><a href="{{ route('user.tables') }}"
                            class="block px-4 py-2 rounded-md bg-slate-500 text-yellow-400 font-bold">Meja</a>
                    </li>
                    <!-- Masih Blom Fix -->
                    <li><a href="#" class="block px-4 py-2 rounded-md hover:text-yellow-400">Event</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded-md hover:text-yellow-400">Profile</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded-md hover:text-yellow-400">Products</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded-md hover:text-yellow-400">Foods</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded-md hover:text-yellow-400">Booking History</a>
                    </li>
                    <li><a href="#" class="block px-4 py-2 rounded-md hover:text-yellow-400">Loyalty Program</a>
                    </li>
                </ul>
            </aside>

            <!-- Main Dashboard Content -->
            <main class="flex-1 p-8 overflow-y-auto">
                <div class="container mx-auto">
                    <h2 class="text-center mb-6 font-bold text-xl text-yellow-400">Available Tables</h2>

                    @if (count($tables) > 0)
                        <div class="flex flex-wrap justify-center gap-6">
                            @foreach ($tables as $table)
                                <div class="table-single bg-gray-800 p-4 rounded-lg shadow-lg w-80 hover:bg-gray-700 transition-all duration-300">
                                    <h4 class="text-center text-xl font-semibold text-yellow-400">Table {{ $table->number }}</h4>
                                    <img src="{{ $table->image_url }}" class="my-2 w-32 h-32 object-cover mx-auto rounded-lg border-4 border-gray-600" />
                                    <p class="text-center text-lg font-bold text-yellow-500">Rp. {{ number_format($table->price) }}/hr</p>
                                    <p class="text-center text-sm font-medium text-gray-300">Capacity: {{ $table->capacity }} people</p>
                                    <p class="text-center font-semibold"
                                        @if ($table->status_flag == 'Open')
                                            style="color: green;"
                                        @elseif ($table->status_flag == 'Taken')
                                            style="color: yellow;"
                                        @elseif ($table->status_flag == 'Closed')
                                            style="color: red;"
                                        @endif>
                                        {{ $table->status_flag }}
                                    </p>

                                    @if (strtolower($table->status_flag) == 'open')
                                        <div class="text-center mt-4">
                                            <a href="{{ route('user.tables.bookView', ['table_id' => $table->id]) }}"
                                               class="inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all duration-300">
                                                Book Now
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-lg text-gray-400">No tables available at the moment!</p>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>

</html>
