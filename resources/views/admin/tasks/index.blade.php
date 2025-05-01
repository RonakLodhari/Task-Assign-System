@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-list-task me-2"></i>Tasks Management
                </h4>
                <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-plus-lg me-2"></i>Add New Task
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-4">Task</th>
                            <th class="border-0">Project</th>
                            <th class="border-0">Assigned To</th>
                            <th class="border-0">Status</th>
                            <th class="border-0">Due Date</th>
                            <th class="border-0 text-end px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" 
                                                {{ $task->status == 'Completed' ? 'checked' : '' }}>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-1">
                                                <a href="{{ route('admin.tasks.show', $task->id) }}" 
                                                   class="text-decoration-none text-dark">
                                                    {{ $task->name }}
                                                </a>
                                            </h6>
                                            <p class="mb-0 text-muted small">{{ Str::limit($task->description, 60) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">
                                        {{ $task->project->title }}
                                    </span>
                                </td>
                                <td>
                                    @if($task->assignedUser)
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                                 style="width: 32px; height: 32px;">
                                                <i class="bi bi-person text-secondary"></i>
                                            </div>
                                            <span class="ms-2">{{ $task->assignedUser->fullname }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">Unassigned</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2
                                        {{ $task->status == 'Completed' ? 'bg-success' : 
                                           ($task->status == 'In Progress' ? 'bg-warning' : 'bg-secondary') }}">
                                        {{ $task->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($task->due_date)
                                        <span class="text-muted">{{ $task->due_date->format('M d, Y') }}</span>
                                    @else
                                        <span class="text-muted">No due date</span>
                                    @endif
                                </td>
                                <td class="text-end px-4">
                                    <a href="{{ route('admin.tasks.edit', $task->id) }}" 
                                       class="btn btn-light btn-sm rounded-pill me-2">
                                        <i class="bi bi-pencil text-warning"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-light btn-sm rounded-pill"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $task->id }}">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach($tasks as $task)
        <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Delete Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete "{{ $task->name }}"?
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger rounded-pill px-4">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
.form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}
.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
}
.card {
    transition: all 0.3s ease;
}
.btn {
    transition: all 0.2s ease;
}
.btn:hover {
    transform: translateY(-2px);
}
</style>
@endsection
