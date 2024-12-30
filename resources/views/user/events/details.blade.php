@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        <!-- Back Button -->
        <a href="{{ route('user.event.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-600 mb-6">
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

                <!-- Cancel -->
                @if ($isRegistered)
                    @if($event->status === 'Open') 
                    <div class="mb-6">
                        <form method="POST" action="{{ route('user.event.cancel', ['event_id' => $event->id]) }}" class="space-y-6">
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure you want to cancel?')"
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-red-400 to-red-600 text-black font-bold rounded-lg hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200">
                            Cancel Registration
                        </button>
                    </div>
                    @endif
                <!-- Register -->
                @else
                    @if($event->status === 'Open') 
                    <div class="mb-6">
                        <form method="POST" action="{{ route('user.event.register', ['event_id' => $event->id]) }}" class="space-y-6">
                        @csrf
                        <button type="submit" 
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-600 text-black font-bold rounded-lg hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200">
                            Confirm Registration
                        </button>
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection