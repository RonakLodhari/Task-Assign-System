@extends('layouts.user')

@section('content')
<div class="create-update-container">
    <div class="form-header">
        <h2><i class="bi bi-plus-circle"></i> Create Update</h2>
        <p class="text-muted">Add a new update to track your progress</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="form-card">
        <form action="{{ route('user.updates.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="project_id">
                        <i class="bi bi-folder"></i> Project
                    </label>
                    <select name="project_id" class="form-select">
                        <option value="">Select Project</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="task_id">
                        <i class="bi bi-list-task"></i> Task
                    </label>
                    <select name="task_id" class="form-select">
                        <option value="">Select Task</option>
                        @foreach ($tasks as $task)
                            <option value="{{ $task->id }}">{{ $task->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="title">
                    <i class="bi bi-type"></i> Title
                </label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">
                    <i class="bi bi-text-paragraph"></i> Description
                </label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="status">
                        <i class="bi bi-flag"></i> Status
                    </label>
                    <select name="status" class="form-select">
                        <option value="Pending">Pending</option>
                        <option value="Reviewed">Reviewed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="other">
                        <i class="bi bi-info-circle"></i> Additional Info
                    </label>
                    <input type="text" name="other" class="form-control">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-circle"></i> Create Update
                </button>
                <a href="{{ route('user.updates.index') }}" class="btn-cancel">
                    <i class="bi bi-arrow-left"></i> Back to Updates
                </a>
            </div>
        </form>
    </div>
</div>

<style>
body {
    background: #f4f7fb;
}
.create-update-container {
    max-width: 800px;
    margin: 40px auto 0 auto;
    padding: 32px 0;
    background: #f4f7fb;
    min-height: 100vh;
}
.form-header {
    text-align: center;
    margin-bottom: 32px;
}
.form-header h2 {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    font-size: 2rem;
    font-weight: 800;
    color: #22223b;
    margin-bottom: 8px;
    letter-spacing: -1px;
}
.form-header p {
    color: #64748b;
    font-size: 1.08rem;
    margin-bottom: 0;
}
.form-card {
    background: #fff;
    border-radius: 18px;
    padding: 38px 36px 32px 36px;
    box-shadow: 0 8px 32px rgba(59,130,246,0.10);
    border-left: 6px solid #6366f1;
}
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 24px;
}
.form-group {
    margin-bottom: 24px;
}
.form-group label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
    color: #1e293b;
    font-weight: 600;
    font-size: 1rem;
}
.form-group label i {
    color: #6366f1;
}
.form-control, .form-select {
    width: 100%;
    padding: 13px 18px;
    border: 2px solid #e0e7ef;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s;
    background-color: #f8fafc;
    color: #22223b;
    box-shadow: 0 2px 8px rgba(59,130,246,0.03);
}
.form-control:focus, .form-select:focus {
    border-color: #6366f1;
    background-color: #fff;
    box-shadow: 0 0 0 4px rgba(99,102,241,0.10);
    outline: none;
}
.form-control::placeholder {
    color: #94a3b8;
}
textarea.form-control {
    resize: vertical;
    min-height: 140px;
}
.form-actions {
    display: flex;
    gap: 18px;
    margin-top: 36px;
    padding-top: 24px;
    border-top: 1px solid #e2e8f0;
}
.btn-submit {
    background: linear-gradient(90deg, #6366f1 60%, #0ea5e9 100%);
    color: #fff;
    padding: 13px 0;
    border: none;
    border-radius: 10px;
    font-size: 1.08rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
    flex: 1;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(59,130,246,0.10);
}
.btn-submit:hover {
    background: linear-gradient(90deg, #0ea5e9 60%, #6366f1 100%);
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 4px 16px rgba(99,102,241,0.13);
}
.btn-cancel {
    background: #f1f5f9;
    color: #475569;
    padding: 13px 0;
    border: none;
    border-radius: 10px;
    font-size: 1.08rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
    flex: 1;
    justify-content: center;
}
.btn-cancel:hover {
    background: #e0e7ef;
    color: #6366f1;
}
.alert {
    border-radius: 10px;
    margin-bottom: 24px;
    padding: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.alert-success {
    background-color: #dcfce7;
    color: #166534;
    border: 1px solid #86efac;
}
.btn-close {
    background: none;
    border: none;
    font-size: 1.3rem;
    color: #64748b;
    opacity: 0.7;
    transition: color 0.2s;
}
.btn-close:hover {
    color: #0ea5e9;
    opacity: 1;
}
@media (max-width: 800px) {
    .form-card {
        padding: 24px 12px;
        border-radius: 14px;
    }
    .create-update-container {
        padding: 16px 0;
    }
}
@media (max-width: 640px) {
    .form-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    .form-actions {
        flex-direction: column;
        gap: 12px;
    }
    .btn-submit, .btn-cancel {
        width: 100%;
    }
}
</style>
@endsection
