@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-info bg-gradient p-4 border-0">
                    <h4 class="mb-0 text-white">
                        <i class="bi bi-info-circle me-2"></i>Task Details
                    </h4>
                </div>

                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">{{ $task->name }}</h5>
                        <span class="badge rounded-pill px-4 py-2 
                            {{ $task->status == 'Completed' ? 'bg-success' : 
                               ($task->status == 'In Progress' ? 'bg-warning' : 'bg-secondary') }}">
                            {{ $task->status }}
                        </span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card h-100 border-0 bg-light rounded-4">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-3">Project</h6>
                                    <p class="card-text">{{ $task->project->title ?? 'No Project Assigned' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100 border-0 bg-light rounded-4">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-3">Assigned To</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="bi bi-person text-info"></i>
                                        </div>
                                        <span class="ms-3">{{ $task->assignedUser->fullname ?? 'Not Assigned' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card border-0 bg-light rounded-4">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-3">Description</h6>
                                    <p class="card-text">{{ $task->description ?? 'No description available.' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100 border-0 bg-light rounded-4">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-3">Created On</h6>
                                    <p class="card-text">{{ $task->created_at->format('d M, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100 border-0 bg-light rounded-4">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-3">Completion Date</h6>
                                    <p class="card-text">
                                        {{ $task->completed_at ? $task->completed_at->format('d M, Y') : 'Not Completed' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.tasks') }}" class="btn btn-light rounded-pill px-4">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>
                        <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn btn-info rounded-pill px-4">
                            <i class="bi bi-pencil-square me-2"></i>Edit Task
                        </a>
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
.btn {
    transition: all 0.2s ease;
}
.btn:hover {
    transform: translateY(-2px);
}
.badge {
    font-weight: 500;
}
</style>
@endsection
