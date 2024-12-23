@extends('admin.layout.app')

@section('title', 'Manage Users')

@section('content')
<div class="container mx-auto p-4 bg-gray-50 min-h-screen">
    <!-- Users List Section -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Users Management</h2>
            <div class="flex gap-4">
                <!-- Create Admin Button -->
                <button onclick="openCreateAdminModal()" 
                        class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg transition-all duration-300">
                    Create Admin Account
                </button>
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Search users..." 
                           class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Users Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" 
                                         src="{{ $user->photo ? Storage::url($user->photo) : asset('images/default-avatar.png') }}" 
                                         alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $user->role_id == 1 ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                {{ $user->role_id == 1 ? 'Admin' : 'Member' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-3">
                                <form action="{{ route('admin.users.reset-password', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                        Reset Password
                                    </button>
                                </form>
                                @if($user->role_id != 1)
                                <button onclick="toggleUserStatus({{ $user->id }})" 
                                        class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                    {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Create Admin Modal -->
<div id="createAdminModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Create Admin Account</h3>
            <button onclick="closeCreateAdminModal()" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form action="{{ route('admin.users.create-admin') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div class="flex justify-end pt-4">
                <button type="submit" 
                        class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg transition-all duration-300">
                    Create Admin
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Modal functions
    function openCreateAdminModal() {
        document.getElementById('createAdminModal').classList.remove('hidden');
    }

    function closeCreateAdminModal() {
        document.getElementById('createAdminModal').classList.add('hidden');
    }

    // Toggle user status
    function toggleUserStatus(userId) {
        if (confirm('Are you sure you want to change this user\'s status?')) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/users/${userId}/toggle-status`;
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            
            form.appendChild(csrfInput);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endpush
@endsection