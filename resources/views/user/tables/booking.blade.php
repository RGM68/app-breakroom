<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white font-sans">

    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-gray-800 p-4 flex justify-between items-center shadow-md">
            <h1 class="text-2xl font-bold text-yellow-400">Breakroom</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-600 px-4 py-2 rounded hover:bg-red-700 text-white font-medium">Logout</button>
            </form>
        </nav>

        <!-- Main Content -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="w-1/4 bg-gray-700 p-6 space-y-4">
                <ul>
                    <li><a href="{{ route('dashboard') }}"
                            class="block px-4 py-2 rounded-md hover:bg-gray-600 hover:text-yellow-400">Home</a>
                    </li>
                    <li><a href="{{ route('user.tables') }}"
                            class="block px-4 py-2 rounded-md {{ Request::is('user/tables') ? 'bg-slate-500 text-yellow-400 font-bold' : 'text-white hover:bg-gray-600 hover:text-yellow-400' }}">Meja</a>
                    </li>
                    <li><a href="#"
                            class="block px-4 py-2 rounded-md hover:bg-gray-600 hover:text-yellow-400">Event</a></li>
                    <li><a href="#"
                            class="block px-4 py-2 rounded-md hover:bg-gray-600 hover:text-yellow-400">Profile</a></li>
                    <li><a href="#"
                            class="block px-4 py-2 rounded-md hover:bg-gray-600 hover:text-yellow-400">Products</a></li>
                    <li><a href="#"
                            class="block px-4 py-2 rounded-md hover:bg-gray-600 hover:text-yellow-400">Foods</a></li>
                    <li><a href="#"
                            class="block px-4 py-2 rounded-md hover:bg-gray-600 hover:text-yellow-400">Booking
                            History</a></li>
                    <li><a href="#"
                            class="block px-4 py-2 rounded-md hover:bg-gray-600 hover:text-yellow-400">Loyalty
                            Program</a></li>
                </ul>
            </aside>

            <!-- Main Dashboard Content -->
            <main class="flex-1 p-8">
                <h2 class="text-3xl font-bold text-yellow-400 mb-6">Booking Meja</h2>

                <div class="booking-table-container max-w-md mx-auto bg-indigo-700 p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-white mb-4">Book Your Table</h3>
                    <form class="space-y-4" method="POST"
                        action="{{ route('user.tables.book', ['table_id' => $table->id]) }}">
                        @csrf

                        <!-- Booking Time -->
                        <div>
                            <label for="datetime" class="text-white block mb-2">Booking Time</label>
                            <input
                                class="w-full p-3 rounded-md bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400"
                                type="datetime-local" name="datetime" id="datetime" value="{{ old('datetime') }}"
                                required>
                        </div>

                        <!-- Duration -->
                        <div>
                            <label for="duration" class="text-white block mb-2">Duration</label>
                            <select
                                class="w-full p-3 rounded-md bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400"
                                name="duration" id="duration" required>
                                <option disabled selected>Pilih Durasi Bermain</option>
                                <option value="180" {{ old('duration') == '180' ? 'selected' : '' }}>Paket 3 Jam
                                </option>
                                <option value="open" {{ old('duration') == 'open' ? 'selected' : '' }}>Open</option>
                            </select>
                        </div>

                        <div id="open-duration-container" class="mt-4 hidden">
                            <label for="duration" class="text-white block mb-2">Enter Open Duration (in
                                minutes)</label>
                            <input type="number" name="duration" id="open-duration"
                                class="w-full p-3 rounded-md bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400"
                                min="1" placeholder="Perkiraan Durasi" value="{{ old('open_duration') }}">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-yellow-500 hover:bg-yellow-600 text-gray-900 p-3 rounded-md mt-4 font-semibold">Book
                            Now</button>
                    </form>

                    <!-- Back Button -->
                    <a href="{{ route('user.tables') }}"
                        class="block text-center mt-4 text-yellow-400 hover:text-yellow-500 font-semibold">Back to Table
                        List</a>
                </div>
            </main>
        </div>
    </div>
    <script>
        document.getElementById('duration').addEventListener('change', function() {
            var openDurationContainer = document.getElementById('open-duration-container');
            if (this.value === 'open') {
                openDurationContainer.classList.remove('hidden');
                document.getElementById('open-duration').required =
                    true;
            } else {
                openDurationContainer.classList.add('hidden');
                document.getElementById('open-duration').required =
                    false;
            }
        });

        document.querySelector('form').addEventListener('submit', function() {
            var durationField = document.getElementById('duration');
            var openDuration = document.getElementById('open-duration').value;

            if (durationField.value === 'open' && openDuration) {
                durationField.value = openDuration;
            }
        });
    </script>
</body>

</html>
