@extends('admin.layout.app')

@section('title', 'Admin Dashboard')

@push('styles')
    @vite(['resources/css/animations.css'])
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-white shadow-sm mb-6">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('photos/breakroom.png') }}" alt="Breakroom Logo" class="h-10">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Welcome Back, {{ auth()->user()->name }}!</h1>
                        <p class="text-sm text-gray-600">{{ now()->format('l, F j, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto p-4">
        <!-- Quick Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            @php
                $quickActions = [
                    ['title' => 'Tables', 'desc' => 'Manage all tables', 'color' => 'blue', 'route' => 'admin.table.index'],
                    ['title' => 'Events', 'desc' => 'Organize and manage events', 'color' => 'purple', 'route' => 'admin.event.adminIndex'],
                    ['title' => 'Products', 'desc' => 'Manage product inventory', 'color' => 'green', 'route' => 'admin.product.adminIndex'],
                    ['title' => 'Food & Drinks', 'desc' => 'Manage menu items', 'color' => 'red', 'route' => 'admin.food.adminIndex']
                ];
            @endphp

            @foreach($quickActions as $index => $action)
                <div class="bg-{{$action['color']}}-50 hover:bg-{{$action['color']}}-100 transition-all duration-300 rounded-xl shadow-md p-6 hover-lift fade-in-up"
                    style="animation-delay: {{$index * 100}}ms">
                    <h3 class="font-bold text-xl mb-3 text-{{$action['color']}}-700">{{$action['title']}}</h3>
                    <p class="text-gray-600 mb-4">{{$action['desc']}}</p>
                    <a href="{{route($action['route'])}}"
                        class="group inline-flex items-center text-{{$action['color']}}-600 hover:text-{{$action['color']}}-800 font-semibold">
                        View All
                        <span class="ml-2 transform transition-transform duration-300 group-hover:translate-x-2">→</span>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Tables Section -->
        <div class="bg-white rounded-xl shadow-lg mb-8 p-6 hover-lift slide-in">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Tables Overview</h2>
                <a href="{{route('admin.table.index')}}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-all duration-300 
                          transform hover:scale-105 hover:shadow-lg inline-flex items-center gap-2">
                    Manage Tables
                    <span class="transform transition-transform group-hover:translate-x-1">→</span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach ($tables as $index => $table)
                    <div class="border rounded-xl p-4 hover-lift fade-in-up 
                                @if($table->status == 'Open') bg-green-50 hover:bg-green-100 
                                @else bg-red-50 hover:bg-red-100 @endif" 
                         style="animation-delay: {{$index * 100}}ms">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="font-bold text-lg">Table {{$table->number}}</h4>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold transition-all duration-300 hover:scale-105
                                @if($table->status == 'Open') 
                                    bg-green-200 text-green-800 hover:bg-green-300
                                @else 
                                    bg-red-200 text-red-800 hover:bg-red-300
                                @endif">
                                {{$table->status}}
                            </span>
                        </div>
                        <div class="overflow-hidden rounded-lg mb-3">
                            <img src="{{Storage::url($table->image)}}" alt="Table {{$table->number}}"
                                class="w-full h-32 object-cover transform transition-transform duration-300 hover:scale-110" />
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-700">Rp. {{number_format($table->price)}}/hr</p>
                            <p class="text-gray-600">Capacity: {{$table->capacity}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Events Section -->
        <div class="bg-white rounded-xl shadow-lg mb-8 p-6 hover-lift slide-in">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Upcoming Events</h2>
                <a href="{{route('admin.event.adminIndex')}}" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded-lg transition-all duration-300 
                          transform hover:scale-105 hover:shadow-lg inline-flex items-center gap-2">
                    Manage Events
                    <span class="transform transition-transform group-hover:translate-x-1">→</span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($events as $index => $event)
                    <div class="border rounded-xl overflow-hidden hover-lift fade-in-up"
                        style="animation-delay: {{($index + 4) * 100}}ms">
                        <div class="overflow-hidden">
                            <img src="{{Storage::url($event->image)}}" alt="{{$event->name}}"
                                class="w-full h-48 object-cover transform transition-transform duration-300 hover:scale-110" />
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <h4 class="font-bold text-xl mb-2">{{$event->name}}</h4>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($event->status == 'Open') 
                                        bg-green-200 text-green-800
                                    @elseif($event->status == 'Ongoing')
                                        bg-yellow-200 text-yellow-800
                                    @else
                                        bg-red-200 text-red-800
                                    @endif">
                                    {{$event->status}}
                                </span>
                            </div>
                            <p class="text-gray-600 mb-2">
                                {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }} at
                                {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}
                            </p>
                            <p class="text-gray-700 mb-3">{{$event->description}}</p>
                            <div class="flex justify-between items-center">
                                <p class="font-semibold text-purple-600">Max: {{$event->max_participants}} participants</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Products and F&B Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Products Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover-lift slide-in">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">Products</h2>
                    <a href="{{route('admin.product.adminIndex')}}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg 
                          transition-all duration-300 transform hover:scale-105 hover:shadow-lg inline-flex items-center gap-2">
                        Manage Products
                        <span class="transform transition-transform group-hover:translate-x-1">→</span>
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($products as $index => $product)
                        <div class="border rounded-xl p-4 hover-lift fade-in-up bg-white hover:bg-gray-50 transition-all duration-300">
                            <div class="overflow-hidden rounded-lg mb-3">
                                <img src="{{Storage::url($product->image)}}" alt="{{$product->name}}" 
                                     class="w-full h-32 object-cover transform transition-transform duration-300 hover:scale-110" />
                            </div>
                            <h4 class="font-bold text-lg text-gray-800 mb-2">{{$product->name}}</h4>
                            <p class="text-lg font-bold text-green-600 mb-2">Rp. {{number_format($product->price)}}</p>
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                @if($product->status == 'Available') 
                                    bg-green-200 text-green-800
                                @else
                                    bg-red-200 text-red-800
                                @endif">
                                {{$product->status}}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Food & Drinks Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover-lift slide-in">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">Food & Drinks</h2>
                    <a href="{{route('admin.food.adminIndex')}}" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg 
                          transition-all duration-300 transform hover:scale-105 hover:shadow-lg inline-flex items-center gap-2">
                        Manage Menu
                        <span class="transform transition-transform group-hover:translate-x-1">→</span>
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($foods as $index => $food)
                        <div class="border rounded-xl p-4 hover-lift fade-in-up bg-white hover:bg-gray-50 transition-all duration-300">
                            <div class="overflow-hidden rounded-lg mb-3">
                                <img src="{{Storage::url($food->image)}}" alt="{{$food->name}}" 
                                     class="w-full h-32 object-cover transform transition-transform duration-300 hover:scale-110" />
                            </div>
                            <div class="space-y-2">
                                <h4 class="font-bold text-lg text-gray-800">{{$food->name}}</h4>
                                <span class="px-2 py-1 bg-gray-100 rounded-md text-sm text-gray-600">
                                    {{$food->category}}
                                </span>
                                <p class="text-lg font-bold text-red-600">Rp. {{number_format($food->price)}}</p>
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                    @if($food->status == 'Available') 
                                        bg-green-200 text-green-800
                                    @else
                                        bg-red-200 text-red-800
                                    @endif">
                                    {{$food->status}}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.fade-in-up, .slide-in').forEach((el) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            observer.observe(el);
        });
    });
</script>
@endpush
@endsection