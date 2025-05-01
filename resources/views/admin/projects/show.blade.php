@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-folder2-open me-2"></i>{{ $project->title }}
                    <span class="badge bg-{{ $project->status == 'Completed' ? 'success' : ($project->status == 'In Progress' ? 'info' : 'warning') }} ms-3">
                        {{ $project->status }}
                    </span>
                </h4>
                <div>
                    <a href="{{ route('admin.projects.edit', $project->id) }}" 
                       class="btn btn-warning btn-sm rounded-pill me-2">
                        <i class="bi bi-pencil-square me-2"></i>Edit Project
                    </a>
                    <a href="{{ route('admin.projects.index') }}" 
                       class="btn btn-light btn-sm rounded-pill">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Info Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Project Description</h5>
                    <p class="text-muted">{{ $project->description }}</p>
                    <div class="row mt-4">
                        <div class="col-md-6 mb-2">
                            <strong><i class="bi bi-calendar-event"></i> Start Date:</strong>
                            {{ $project->start_date ? $project->start_date->format('d M Y') : 'Not Set' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong><i class="bi bi-calendar2-check"></i> End Date:</strong>
                            {{ $project->end_date ? $project->end_date->format('d M Y') : 'Not Set' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong><i class="bi bi-calendar-plus"></i> Created:</strong>
                            {{ $project->created_at->format('d M Y') }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong><i class="bi bi-calendar-check"></i> Last Updated:</strong>
                            {{ $project->updated_at->format('d M Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Assigned Users Section -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Assigned To</h5>
                    @if($project->assignedUsers && $project->assignedUsers->count())
                        @foreach($project->assignedUsers as $user)
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                     style="width: 40px; height: 40px;">
                                    <i class="bi bi-person text-secondary"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">{{ $user->fullname }}</h6>
                                    <p class="mb-0 text-muted small">{{ $user->email }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="mb-0 text-muted">No user assigned</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Project Tasks Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Project Tasks</h5>
                <a href="{{ route('admin.tasks.create', ['project_id' => $project->id]) }}" 
                   class="btn btn-primary btn-sm rounded-pill">
                    <i class="bi bi-plus-lg me-2"></i>Add Task
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(isset($tasks) && $tasks->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Assigned User</th>
                                <th>Due Date</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>
                                        <span class="badge bg-{{ $task->status == 'Completed' ? 'success' : ($task->status == 'In Progress' ? 'info' : 'warning') }}">
                                            {{ $task->status }}
                                        </span>
                                    </td>
                                    <td>{{ $task->assignedUser->fullname ?? 'Unassigned' }}</td>
                                    <td>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'Not Set' }}</td>
                                    <td>{{ $task->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.tasks.show', $task->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted mb-0">No tasks found for this project.</p>
            @endif
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 10px;
}
.btn {
    padding: 0.5rem 1rem;
}
.rounded-pill {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}
</style>
@endsection
