@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <a href="{{route('dashboard')}}"
            class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-200 transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
            Back to Dashboard
        </a>
        <h2 class="text-black text-2xl font-bold mb-6">Loyalty Program</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <p class="text-black">You have:</p>
        <div class="text-center">
            <h1 class="text-black" style="font-size: 100px">{{$user->loyalty_points}}</h1>
        </div>
        <p class="text-black text-end">Loyalty Points</p>

        <h2 class="text-black text-2xl font-bold mb-6">Rewards</h2>

    </div>
</div>
@endsection