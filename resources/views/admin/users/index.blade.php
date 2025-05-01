@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center animate__animated animate__fadeInDown">User Management</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success animate__animated animate__fadeIn">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3 shadow-lg"><i class="fa fa-plus-circle"></i> Add New User</a>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 shadow-lg rounded">
            <thead class="bg-primary text-white">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>User Type</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="animate__animated animate__fadeInUp">
                        <td>{{ $user->id }}</td>
                        <td>
                            @if ($user->image)
                                <img src="{{ asset($user->image) }}" alt="{{ $user->fullname }}'s Profile Image" class="rounded-circle shadow" width="40" height="40">
                            @else
                                <i class="bi bi-person-circle fs-3 text-muted"></i>
                            @endif
                        </td>
                        
                        <td><a href="{{ route('admin.users.show', $user->id) }}" class="text-primary font-weight-bold">{{ $user->fullname }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td class="text-capitalize"><span class="badge bg-info text-white">{{ $user->role }}</span></td>
                        <td class="text-capitalize"><span class="text-black">{{ $user->usertype }}</span></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info shadow me-1">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning shadow me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger shadow" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .table-hover tbody tr:hover { 
        background-color: #f8f9fa;
        transform: scale(1.01);
        transition: all 0.2s ease;
    }
    .btn-group .btn {
        border-radius: 4px !important;
    }
    .btn-group .btn:hover {
        transform: translateY(-2px);
        transition: all 0.2s ease;
    }
    .shadow-lg { 
        transition: all 0.3s ease-in-out;
        border-radius: 15px;
        overflow: hidden;
    }
</style>
@endsection