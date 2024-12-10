@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Our Products</h1>

    @if($products->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-600">No products available at the moment.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Product Image -->
                    <div class="relative h-48 overflow-hidden">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">No image available</span>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        @if($product->status === 'Available')
                            <span class="absolute top-2 right-2 px-2 py-1 bg-green-500 text-white text-sm rounded-full">
                                Available
                            </span>
                        @else
                            <span class="absolute top-2 right-2 px-2 py-1 bg-red-500 text-white text-sm rounded-full">
                                Unavailable
                            </span>
                        @endif
                    </div>

                    <!-- Product Details -->
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                        
                        <div class="mb-4 text-sm text-gray-600">
                            <!-- Price -->
                            <p class="mb-1 text-lg font-bold text-blue-600">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            
                            <!-- Description -->
                            <p class="text-gray-600 mb-4 line-clamp-2">{{ $product->description }}</p>
                        </div>

                        <!-- View Details Button -->
                        <div class="flex justify-center">
                            <a href="{{ route('products.details', $product->id) }}" 
                               class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination if needed -->
        @if($products->hasPages())
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @endif
    @endif
</div>
@endsection