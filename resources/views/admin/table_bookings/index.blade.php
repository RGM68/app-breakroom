@extends('admin.layout.app')

@section('title', 'Admin Table Bookings Page')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 animate-fade-in">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h2 class="text-3xl font-bold text-gray-900 animate-slide-in">Bookings</h2>
            <div class="space-x-0 sm:space-x-4 flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                <a href="{{ route('admin.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-200 transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Back to Dashboard
                </a>
            </div>
        </div>

        {{-- <!-- Tables Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <table class="table">
        <thead>
            <tr>
                <th>Table</th>
                <th>User</th>
                <th>Email</th>
                <th>Booking Date</th>
                <th>Booking Time</th>
                <th>Duration</th>
                <th>Original Price</th>
                <th>Loyalty Discount</th>
                <th>Voucher Discount</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        @foreach ($bookings as $booking)     
        <tr>
            <td>{{ $booking->table->number ?? 'Unknown Table' }}</td>
            <td>{{ $booking->user->name ?? 'Unknown User' }}</td>
            <td>{{ $booking->user->email ?? 'Unknown User' }}</td>
            <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('d, M, Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</td>
            <td>{{ floor($booking->duration / 60) }} Hour(s) {{$booking->duration % 60}} Minutes</td>
            <td>Rp. {{ number_format($booking->original_price, 2) }}</td>
            <td>Rp. {{ number_format($booking->loyalty_discount, 2) }}</td>
            <td>Rp. {{ number_format($booking->voucher_discount, 2) }}</td>
            <td>Rp. {{ number_format($booking->final_price, 2) }}</td>
            <td>
                <!-- Finish -->
                <a href="{{route('admin.booking.finish', $booking->id)}}"class="btn btn-primary m-2">Finish</a>
                <a href="{{route('admin.booking.cancel', $booking->id)}}"class="btn btn-danger m-2">Cancel</a>
            </td>
        </tr>
        @endforeach
    </table>
    </div> --}}

        <!-- Active Sessions Section -->
        <div class="bg-gray-800/50 backdrop-blur rounded-lg p-6 mb-8">
            <h3 class="text-xl font-semibold text-yellow-400 mb-4">Active Sessions</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-300 border-b border-gray-700">
                            <th class="px-4 py-3">Table</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Started At</th>
                            <th class="px-4 py-3">Duration</th>
                            {{-- <th class="px-4 py-3">Original Price</th> --}}
                            {{-- <th class="px-4 py-3">Discounts</th> --}}
                            <th class="px-4 py-3">Current Price</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings->where('status', 'active') as $booking)
                            <tr class="border-b border-gray-700" id="booking-{{ $booking->id }}">
                                <td class="px-4 py-3">Table #{{ $booking->table->number }}</td>
                                <td class="px-4 py-3">
                                    <div>
                                        <p class="font-medium">{{ $booking->user->name }}</p>
                                        <p class="text-sm text-gray-400">{{ $booking->user->email }}</p>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 rounded text-sm {{ $booking->booking_type === '3-hour-package' ? 'bg-blue-900 text-blue-300' : 'bg-purple-900 text-purple-300' }}">
                                        {{ $booking->booking_type === '3-hour-package' ? '3-Hour Package' : 'Open Duration' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($booking->started_at)->format('H:i') }}</td>
                                <td class="px-4 py-3">
                                    <span class="duration-timer" id="duration-timer">Calculating...</span>
                                </td>
                                {{-- <td class="px-4 py-3">
                                    <span class="original-price"
                                        id="original-price">Calculating...</span>
                                </td> --}}
                                {{-- <td class="px-4 py-3">
                                    <div class="text-sm">
                                        @if ($booking->loyalty_discount)
                                            <p class="text-green-400">Loyalty: -Rp
                                                {{ number_format($booking->loyalty_discount, 0, ',', '.') }}</p>
                                        @endif
                                        @if ($booking->voucher_discount)
                                            <p class="text-green-400">Voucher: -Rp
                                                {{ number_format($booking->voucher_discount, 0, ',', '.') }}</p>
                                        @endif
                                    </div>
                                </td> --}}
                                <td class="px-4 py-3">
                                    <span class="current-price font-bold" id="current-price">Calculating...</span>
                                </td>
                                <td class="px-4 py-3">
                                    <button onclick="endSession({{ $booking->id }})"
                                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                        End Session
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pending Bookings Section -->
        <div class="bg-gray-800/50 backdrop-blur rounded-lg p-6">
            <h3 class="text-xl font-semibold text-yellow-400 mb-4">Pending Bookings</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-300 border-b border-gray-700">
                            <th class="px-4 py-3">Table</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Booking Time</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings->where('status', 'pending') as $booking)
                            <tr class="border-b border-gray-700" id="booking-{{ $booking->id }}">
                                <td class="px-4 py-3">Table #{{ $booking->table->number }}</td>
                                <td class="px-4 py-3">{{ $booking->user->name }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 rounded text-sm 
                                {{ $booking->booking_type === '3-hour-package' ? 'bg-blue-900 text-blue-300' : 'bg-purple-900 text-purple-300' }}">
                                        {{ $booking->booking_type === '3-hour-package' ? '3-Hour Package' : 'Open Duration' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    {{ Carbon\Carbon::parse($booking->booking_time)->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3">{{ $booking->price_display }}</td>
                                <td class="px-4 py-3">
                                    <button onclick="startSession({{ $booking->id }})"
                                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                        Start Session
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Completed Sessions --}}
        <div class="bg-gray-800/50 backdrop-blur rounded-lg p-6 mt-8">
            <h3 class="text-xl font-semibold text-yellow-400 mb-4">Completed Bookings</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-300 border-b border-gray-700">
                            <th class="px-4 py-3">Table</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Start Time</th>
                            <th class="px-4 py-3">End Time</th>
                            <th class="px-4 py-3">Duration</th>
                            <th class="px-4 py-3">Original Price</th>
                            <th class="px-4 py-3">Discounts</th>
                            <th class="px-4 py-3">Final Price</th>
                            <th class="px-4 py-3">Points Earned</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings->where('status', 'completed') as $booking)
                            <tr class="border-b border-gray-700">
                                <td class="px-4 py-3">Table #{{ $booking->table->number }}</td>
                                <td class="px-4 py-3">
                                    <div>
                                        <p class="font-medium">{{ $booking->user->name }}</p>
                                        <p class="text-sm text-gray-400">{{ $booking->user->email }}</p>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 rounded text-sm {{ $booking->booking_type === '3-hour-package' ? 'bg-blue-900 text-blue-300' : 'bg-purple-900 text-purple-300' }}">
                                        {{ $booking->booking_type === '3-hour-package' ? '3-Hour Package' : 'Open Duration' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($booking->started_at)->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($booking->end_time)->format('d M Y H:i') }}
                                </td>
                                <td class="px-4 py-3">{{ floor($booking->final_duration / 60) }}h
                                    {{ $booking->final_duration % 60 }}m</td>
                                <td class="px-4 py-3">Rp {{ number_format($booking->original_price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <div class="text-sm">
                                        @if ($booking->loyalty_discount)
                                            <p class="text-green-400">Loyalty: -Rp
                                                {{ number_format($booking->loyalty_discount, 0, ',', '.') }}</p>
                                        @endif
                                        @if ($booking->voucher_discount)
                                            <p class="text-green-400">Voucher: -Rp
                                                {{ number_format($booking->voucher_discount, 0, ',', '.') }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-bold">Rp {{ number_format($booking->final_price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3">{{ floor($booking->final_price / 10000) }} points</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Cancelled Sessions --}}
        <div class="bg-gray-800/50 backdrop-blur rounded-lg p-6 mt-8">
            <h3 class="text-xl font-semibold text-yellow-400 mb-4">Cancelled Bookings</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-300 border-b border-gray-700">
                            <th class="px-4 py-3">Table</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Original Booking Time</th>
                            <th class="px-4 py-3">Started At</th>
                            <th class="px-4 py-3">Cancelled At</th>
                            <th class="px-4 py-3">Duration Before Cancel</th>
                            <th class="px-4 py-3">Original Price</th>
                            <th class="px-4 py-3">Applied Discounts</th>
                            <th class="px-4 py-3">Final Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings->where('status', 'cancelled') as $booking)
                            <tr class="border-b border-gray-700">
                                <td class="px-4 py-3">Table #{{ $booking->table->number }}</td>
                                <td class="px-4 py-3">
                                    <div>
                                        <p class="font-medium">{{ $booking->user->name }}</p>
                                        <p class="text-sm text-gray-400">{{ $booking->user->email }}</p>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 rounded text-sm {{ $booking->booking_type === '3-hour-package' ? 'bg-blue-900 text-blue-300' : 'bg-purple-900 text-purple-300' }}">
                                        {{ $booking->booking_type === '3-hour-package' ? '3-Hour Package' : 'Open Duration' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    {{ Carbon\Carbon::parse($booking->booking_time)->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3">
                                    @if ($booking->started_at)
                                        {{ Carbon\Carbon::parse($booking->started_at)->format('d M Y H:i') }}
                                    @else
                                        <span class="text-gray-400">Not started</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $booking->updated_at->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3">
                                    @if ($booking->started_at)
                                        {{ floor($booking->final_duration / 60) }}h {{ $booking->final_duration % 60 }}m
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if ($booking->original_price)
                                        Rp {{ number_format($booking->original_price, 0, ',', '.') }}
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm">
                                        @if ($booking->loyalty_discount)
                                            <p class="text-green-400">Loyalty: -Rp
                                                {{ number_format($booking->loyalty_discount, 0, ',', '.') }}</p>
                                        @endif
                                        @if ($booking->voucher_discount)
                                            <p class="text-green-400">Voucher: -Rp
                                                {{ number_format($booking->voucher_discount, 0, ',', '.') }}</p>
                                        @endif
                                        @if (!$booking->loyalty_discount && !$booking->voucher_discount)
                                            <span class="text-gray-400">No discounts applied</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if ($booking->final_price)
                                        <span class="font-bold">Rp
                                            {{ number_format($booking->final_price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .animate-slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }

        .animate-fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.5s ease-out forwards;
        }

        @keyframes statusChange {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .status-change {
            animation: statusChange 0.3s ease-in-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Status change animation
            const statusSelects = document.querySelectorAll('select[name="status"]');
            statusSelects.forEach(select => {
                select.addEventListener('change', function() {
                    const card = this.closest('.bg-white');
                    const statusBadge = card.querySelector('.rounded-full');
                    statusBadge.classList.add('status-change');
                    setTimeout(() => {
                        statusBadge.classList.remove('status-change');
                    }, 300);
                });
            });
        });

        function startSession(bookingId) {
            if (!confirm('Are you sure you want to start this session?')) return;

            fetch(`/admin/bookings/${bookingId}/start`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || 'Error starting session');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error starting session');
                });
        }

        function endSession(bookingId) {
            if (!confirm('Are you sure you want to end this session?')) return;

            fetch(`/admin/bookings/${bookingId}/end`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || 'Error ending session');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error ending session');
                });
        }

        function fetchUpdatedPrices() {
            fetch('{{ route('admin.bookings.prices') }}')
                .then(response => response.json())
                .then(data => {
                    data.forEach(booking => {
                        const bookingRow = document.querySelector(`#booking-${booking.id}`);
                        if (bookingRow) {
                            const currPrice = bookingRow.querySelector(`#current-price`);
                            if (currPrice) {
                                console.log('done price' + booking.id)
                                currPrice.textContent = booking.price_display;
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching prices:', error));
        }

        function fetchUpdatedDurations() {
            fetch('{{ route('admin.bookings.durations') }}')
                .then(response => response.json())
                .then(data => {
                    data.forEach(booking => {
                        const bookingRow = document.querySelector(`#booking-${booking.id}`);
                        if (bookingRow) {
                            const durationTimer = bookingRow.querySelector(`#duration-timer`);
                            if (durationTimer) {
                                console.log('done duration' + booking.id)
                                durationTimer.textContent = booking.duration_display;
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching durations:', error));
        }

        setInterval(fetchUpdatedDurations, 1000);
        setInterval(fetchUpdatedPrices, 30000);
        fetchUpdatedDurations();
        fetchUpdatedPrices();
    </script>
@endsection
