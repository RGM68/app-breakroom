@extends('admin.layout.app')

@section('title', 'Admin Table Bookings Page')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 animate-fade-in">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-3xl font-bold text-gray-900 animate-slide-in">Bookings</h2>
        <div class="space-x-0 sm:space-x-4 flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
            <a href="{{route('admin.index')}}" 
               class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-200 transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Tables Grid -->
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
            <td>Rp. {{ number_format($booking->total_price, 2) }}</td>
            <td>
                <!-- Finish -->
                <a href="{{route('admin.booking.finish', $booking->id)}}"class="btn btn-primary m-2">Finish</a>
                <a href="{{route('admin.booking.cancel', $booking->id)}}"class="btn btn-danger m-2">Cancel</a>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideIn {
        from { transform: translateX(-20px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
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
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
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
</script>
@endsection