@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body text-center p-5">
                    <div class="position-relative mb-4">
                        <img src="{{ asset($user->image ?? 'uploads/users/default.png') }}" 
                             alt="{{ $user->fullname }}'s Profile" 
                             class="rounded-circle shadow-lg"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <span class="position-absolute bottom-0 end-0 bg-success p-2 rounded-circle">
                            <i class="bi bi-check-lg text-white"></i>
                        </span>
                    </div>
                    <h3 class="fw-bold mb-1">{{ $user->fullname }}</h3>
                    <p class="text-muted mb-4">{{ ucfirst($user->role) }}</p>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                           class="btn btn-primary btn-lg rounded-pill">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profile
                        </a>
                        <a href="{{ route('admin.users.index') }}" 
                           class="btn btn-light btn-lg rounded-pill">
                            <i class="bi bi-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="card border-0 shadow-lg rounded-4 mt-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-person-lines-fill me-2"></i>Contact Info</h5>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light p-2 rounded-circle me-3">
                            <i class="bi bi-envelope text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Email</small>
                            <span>{{ $user->email }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light p-2 rounded-circle me-3">
                            <i class="bi bi-telephone text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Phone</small>
                            <span>{{ $user->phone }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bg-light p-2 rounded-circle me-3">
                            <i class="bi bi-geo-alt text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Address</small>
                            <span>{{ $user->address }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Skills Section -->
            <div class="card border-0 shadow-lg rounded-4 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4"><i class="bi bi-code-slash me-2"></i>Technical Skills</h4>
                    @if($user->usertype == 'frontend developer')
                        <h6 class="text-muted mb-3">Frontend Technologies</h6>
                        <div class="mb-4">
                            @foreach(json_decode($user->frontend_languages ?? '[]', true) as $lang)
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 me-2 mb-2">
                                    {{ $lang }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                    @if($user->usertype == 'backend developer')
                        <h6 class="text-muted mb-3">Backend Technologies</h6>
                        <div class="mb-4">
                            @foreach(json_decode($user->backend_languages ?? '[]', true) as $lang)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 me-2 mb-2">
                                    {{ $lang }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Projects Section -->
            <div class="card border-0 shadow-lg rounded-4 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4"><i class="bi bi-folder me-2"></i>Assigned Projects</h4>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>Project Name</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                                    <i class="bi bi-folder text-primary"></i>
                                                </div>
                                                {{ $project->title }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill 
                                                {{ $project->status == 'Pending' ? 'bg-warning' : 
                                                   ($project->status == 'Completed' ? 'bg-success' : 'bg-info') }}">
                                                {{ $project->status }}
                                            </span>
                                        </td>
                                        <td style="width: 40%;">
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-success" 
                                                     role="progressbar" 
                                                     style="width: {{ $project->status == 'Completed' ? '100' : '65' }}%">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tasks Section -->
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4"><i class="bi bi-list-task me-2"></i>Assigned Tasks</h4>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>Task Name</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                                    <i class="bi bi-check-circle text-info"></i>
                                                </div>
                                                {{ $task->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill 
                                                {{ $task->status == 'Pending' ? 'bg-warning' : 
                                                   ($task->status == 'Completed' ? 'bg-success' : 'bg-primary') }}">
                                                {{ $task->status }}
                                            </span>
                                        </td>
                                        <td style="width: 40%;">
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-info" 
                                                     role="progressbar" 
                                                     style="width: {{ $task->status == 'Completed' ? '100' : '45' }}%">
                                                </div>
                                            </div>
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
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.progress {
    border-radius: 10px;
    background-color: #f1f3f4;
}

.progress-bar {
    border-radius: 10px;
}

.badge {
    font-weight: 500;
}

.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}
</style>
@endsection
