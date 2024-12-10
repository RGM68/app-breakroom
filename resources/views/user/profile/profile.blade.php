@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-black text-2xl font-bold mb-6">Profile Settings</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" 
                    value="{{ old('name', $user->name) }}"
                    class="mt-1 text-black block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Current Profile Photo</label>
                <div class="mt-2">
                    @if($user->photo)
                        <img src="{{ Storage::url($user->photo) }}" alt="Profile Photo" class="h-32 w-32 rounded-full object-cover">
                    @else
                        <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No photo</span>
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700">Update Profile Photo</label>
                <input type="file" name="photo" id="photo" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-medium
                    file:bg-indigo-50 file:text-indigo-700
                    hover:file:bg-indigo-100">
                @error('photo')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Accepted formats: JPG, PNG, GIF. Max size: 2MB</p>
            </div>

            <div class="pt-4">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Save Changes
                </button>
            </div>
        </form>

        <div class="mt-8 pt-8 border-t border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Account Information</h3>
            <div class="space-y-4">
                <div>
                    <p class="text-sm font-medium text-gray-500">Email Address</p>
                    <p class="text-black mt-1">{{ $user->email }}</p>
                    <p class="mt-2 text-sm text-gray-500">Email change functionality coming soon.</p>
                </div>

                <div>
                    <p class="text-sm font-medium text-gray-500">Account Created</p>
                    <p class="text-black mt-1">{{ $user->created_at->format('F j, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection