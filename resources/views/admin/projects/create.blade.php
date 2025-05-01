@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary bg-gradient p-4 border-0">
                    <h4 class="mb-0 text-white">
                        <i class="bi bi-folder-plus me-2"></i>Create New Project
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.projects.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">Project Title</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-bookmark text-primary"></i>
                                </span>
                                <input type="text" name="title" id="title" 
                                    class="form-control border-0 bg-light @error('title') is-invalid @enderror" 
                                    placeholder="Enter project title" value="{{ old('title') }}" required>
                            </div>
                            @error('title')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-text-paragraph text-primary"></i>
                                </span>
                                <textarea name="description" id="description" 
                                    class="form-control border-0 bg-light @error('description') is-invalid @enderror" 
                                    rows="4" placeholder="Enter project description">{{ old('description') }}</textarea>
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
                                        <i class="bi bi-flag text-primary"></i>
                                    </span>
                                    <select name="status" id="status" 
                                        class="form-select border-0 bg-light @error('status') is-invalid @enderror">
                                        <option value="Pending">Pending</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
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
                                        <i class="bi bi-person text-primary"></i>
                                    </span>
                                    <select name="assigned_to[]" id="assigned_to" 
                                        class="form-select border-0 bg-light @error('assigned_to') is-invalid @enderror" 
                                        multiple>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ (collect(old('assigned_to'))->contains($user->id)) ? 'selected' : '' }}>
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
                                    <i class="bi bi-calendar-event text-primary"></i>
                                </span>
                                <input type="date" name="end_date" id="end_date"
                                    class="form-control border-0 bg-light @error('end_date') is-invalid @enderror"
                                    value="{{ old('end_date') }}">
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
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-check-lg me-2"></i>Create Project
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
