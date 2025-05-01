@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-warning bg-gradient p-4 border-0">
                    <h4 class="mb-0 text-white">
                        <i class="bi bi-pencil-square me-2"></i>Edit Project
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">Project Title</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-bookmark text-warning"></i>
                                </span>
                                <input type="text" name="title" id="title" 
                                    class="form-control border-0 bg-light @error('title') is-invalid @enderror" 
                                    value="{{ old('title', $project->title) }}" required>
                            </div>
                            @error('title')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-text-paragraph text-warning"></i>
                                </span>
                                <textarea name="description" id="description" 
                                    class="form-control border-0 bg-light @error('description') is-invalid @enderror" 
                                    rows="4">{{ old('description', $project->description) }}</textarea>
                            </div>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label fw-bold">Status</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="bi bi-flag text-warning"></i>
                                    </span>
                                    <select name="status" id="status" 
                                        class="form-select border-0 bg-light @error('status') is-invalid @enderror">
                                        <option value="Pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="In Progress" {{ $project->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="assigned_to" class="form-label fw-bold">Assign To</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="bi bi-person text-warning"></i>
                                    </span>
                                    <select name="assigned_to[]" id="assigned_to" 
                                        class="form-select border-0 bg-light @error('assigned_to') is-invalid @enderror"
                                        multiple>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" 
                                                {{ (isset($project) && $project->assignedUsers->contains($user->id)) ? 'selected' : '' }}>
                                                {{ $user->fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                @error('assigned_to')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Add this block for Last Date (End Date) -->
                        <div class="mb-4">
                            <label for="end_date" class="form-label fw-bold">Last Date</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-calendar-event text-warning"></i>
                                </span>
                                <input type="date" name="end_date" id="end_date"
                                    class="form-control border-0 bg-light @error('end_date') is-invalid @enderror"
                                    value="{{ old('end_date', $project->end_date ? $project->end_date->format('Y-m-d') : '') }}">
                            </div>
                            @error('end_date')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.projects.index') }}" 
                               class="btn btn-light rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-warning rounded-pill px-4">
                                <i class="bi bi-save me-2"></i>Update Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus, .form-select:focus {
    box-shadow: none;
    border-color: #dee2e6;
}
.input-group-text {
    border-right: 0;
}
.form-control, .form-select {
    border-left: 0;
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
