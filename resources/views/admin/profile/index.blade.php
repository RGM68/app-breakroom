<!-- resources/views/admin/profile/index.blade.php -->
@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Profile Settings</h5>
                    @if(auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" 
                             alt="Profile" 
                             class="rounded-circle"
                             style="width: 40px; height: 40px; object-fit: cover;">
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Profile Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" value="{{ auth()->user()->phone_number }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control">{{ auth()->user()->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Birth Date</label>
                            <input type="date" name="birth_date" class="form-control" value="{{ auth()->user()->birth_date }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" class="form-control">{{ auth()->user()->bio }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- resources/views/admin/users/index.blade.php -->
@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Manage Users</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('admin.users.reset-password', $user->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to reset this user\'s password?');">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Reset Password</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection