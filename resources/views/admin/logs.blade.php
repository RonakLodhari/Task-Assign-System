@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="bi bi-activity text-primary me-2"></i>System Activity Logs
        </h4>
        <div class="search-box">
            <input type="text" id="logSearch" class="form-control bg-light border-0 rounded-pill px-4" 
                   placeholder="Search logs..." style="width: 250px;">
        </div>
    </div>

    <!-- Recent Logins Card -->
    <div class="card border-0 shadow-lg rounded-4 mb-4">
        <div class="card-header bg-primary bg-gradient p-4 border-0">
            <h5 class="mb-0 text-white">
                <i class="bi bi-people me-2"></i>User Activity Monitor
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-4">User</th>
                            <th class="border-0">Login Time</th>
                            <th class="border-0">Logout Time</th>
                            <th class="border-0">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @php
                                $is_active = $user->login_time && (!$user->logout_time || \Carbon\Carbon::parse($user->logout_time)->lessThan($user->login_time));
                            @endphp
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        @if (!empty($user->image) && file_exists(public_path($user->image)))
                                            <img src="{{ asset($user->image) }}" alt="Profile" 
                                                 class="rounded-circle" width="40" height="40">
                                        @else
                                            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" 
                                                 style="width: 40px; height: 40px;">
                                                <i class="bi bi-person text-primary"></i>
                                            </div>
                                        @endif
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ $user->fullname }}</h6>
                                            <small class="text-muted">#{{ $user->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($user->login_time)
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-box-arrow-in-right text-success me-2"></i>
                                            {{ \Carbon\Carbon::parse($user->login_time)->format('h:i A, d M Y') }}
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->logout_time)
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-box-arrow-right text-danger me-2"></i>
                                            {{ \Carbon\Carbon::parse($user->logout_time)->format('h:i A, d M Y') }}
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($is_active)
                                        <span class="badge bg-success-subtle text-success rounded-pill px-3">Active</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger rounded-pill px-3">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Project Assignments Card -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-header bg-info bg-gradient p-4 border-0">
                    <h5 class="mb-0 text-white">
                        <i class="bi bi-folder me-2"></i>Project Assignments
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 px-4">Project</th>
                                    <th class="border-0">Assigned To</th>
                                    <th class="border-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td class="px-4">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-info bg-opacity-10 d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="bi bi-folder2 text-info"></i>
                                                </div>
                                                <span class="ms-3">{{ $project->title }}</span>
                                            </div>
                                        </td>
                                        <td>{{ optional($project->assignedUser)->fullname ?? 'Unassigned' }}</td>
                                        <td>
                                            <span class="badge bg-info-subtle text-info rounded-pill px-3">
                                                {{ $project->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-header bg-success bg-gradient p-4 border-0">
                    <h5 class="mb-0 text-white">
                        <i class="bi bi-list-check me-2"></i>Task Assignments
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 px-4">Task</th>
                                    <th class="border-0">Assigned To</th>
                                    <th class="border-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="px-4">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="bi bi-check2-square text-success"></i>
                                                </div>
                                                <span class="ms-3">{{ $task->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ optional($task->assignedUser)->fullname ?? 'Unassigned' }}</td>
                                        <td>
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                                {{ $task->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    box-shadow: none;
    border-color: #dee2e6;
}
.card {
    transition: all 0.3s ease;
}
.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
}
.badge {
    font-weight: 500;
}
</style>

<script>
document.getElementById('logSearch').addEventListener('keyup', function() {
    let searchText = this.value.toLowerCase();
    let rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchText) ? '' : 'none';
    });
});
</script>
@endsection
