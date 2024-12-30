@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <a href="{{route('dashboard')}}"
            class="inline-flex items-center justify-center px-4 py-2 mb-2 bg-gray-100 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-200 transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
            Back to Dashboard
        </a>
    <h1 class="text-3xl font-bold mb-8">Upcoming Events</h1>
    @if($events->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-600">No upcoming events at the moment.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Event Image -->
                    <div class="relative h-48 overflow-hidden">
                        @if($event->image)
                            <img src="{{ Storage::url($event->image) }}" 
                                 alt="{{ $event->name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">No image available</span>
                            </div>
                        @endif
                    </div>

                    <!-- Event Details -->
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $event->name }}</h2>
                        
                        <div class="mb-4 text-sm text-gray-600">
                            <p class="mb-1">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}
                            </p>
                            <p class="mb-1">
                                <i class="fas fa-clock mr-2"></i>
                                {{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}
                            </p>
                            <p class="mb-1">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ $event->location }}
                            </p>
                        </div>

                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $event->description }}</p>

                        <!-- View Details Button -->
                        <div class="flex justify-center">
                            <a href="{{ route('user.event.details', $event->id) }}" 
                               class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection