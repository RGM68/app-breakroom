@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <a href="{{ route('event.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-600 mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Back to Events
        </a>

        <!-- Event Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Event Image -->
            @if($event->image)
                <div class="h-96 overflow-hidden">
                    <img src="{{ Storage::url($event->image) }}" 
                         alt="{{ $event->name }}" 
                         class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Event Content -->
            <div class="p-6">
                <h1 class="text-3xl font-bold mb-4">{{ $event->name }}</h1>

                <!-- Event Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Date & Time</h3>
                        <p class="text-gray-600 mb-1">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}
                        </p>
                        <p class="text-gray-600">
                            <i class="fas fa-clock mr-2"></i>
                            {{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Location</h3>
                        <p class="text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $event->location }}
                        </p>
                    </div>
                </div>

                <!-- Capacity -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Event Capacity</h3>
                    <p class="text-gray-600">
                        <i class="fas fa-users mr-2"></i>
                        Maximum {{ $event->max_participants }} participants
                    </p>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Description</h3>
                    <div class="prose max-w-none text-gray-600">
                        {{ $event->description }}
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Event Status</h3>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        @if($event->status === 'Open') 
                            bg-green-100 text-green-800
                        @else 
                            bg-red-100 text-red-800
                        @endif">
                        {{ $event->status }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection