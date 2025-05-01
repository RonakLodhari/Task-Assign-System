@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4 text-center fw-bold text-primary animate__animated animate__fadeInDown">Admin Dashboard</h1>
    
    <!-- Stats Cards Row -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 bg-gradient-primary text-white shadow-lg rounded-4 overflow-hidden">
                <div class="card-body position-relative p-4">
                    <div class="icon-background position-absolute">
                        <i class="bi bi-people-fill opacity-25 display-1"></i>
                    </div>
                    <h5 class="card-title fw-light">Total Users</h5>
                    <p class="card-text display-4 fw-bold mb-0 count-up" data-count="{{ $totalUsers }}">0</p>
                    <div class="progress mt-3 bg-white bg-opacity-25" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: 75%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 bg-gradient-info text-white shadow-lg rounded-4 overflow-hidden">
                <div class="card-body position-relative p-4">
                    <div class="icon-background position-absolute">
                        <i class="bi bi-check2-circle opacity-25 display-1"></i>
                    </div>
                    <h5 class="card-title fw-light">Completed Tasks</h5>
                    <p class="card-text display-4 fw-bold mb-0 count-up" data-count="{{ $completedTasks }}">0</p>
                    <div class="progress mt-3 bg-white bg-opacity-25" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: 65%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 bg-gradient-success text-white shadow-lg rounded-4 overflow-hidden">
                <div class="card-body position-relative p-4">
                    <div class="icon-background position-absolute">
                        <i class="bi bi-folder-fill opacity-25 display-1"></i>
                    </div>
                    <h5 class="card-title fw-light">Total Projects</h5>
                    <p class="card-text display-4 fw-bold mb-0 count-up" data-count="{{ $totalProjects }}">0</p>
                    <div class="progress mt-3 bg-white bg-opacity-25" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: 85%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 bg-gradient-warning text-white shadow-lg rounded-4 overflow-hidden">
                <div class="card-body position-relative p-4">
                    <div class="icon-background position-absolute">
                        <i class="bi bi-list-task opacity-25 display-1"></i>
                    </div>
                    <h5 class="card-title fw-light">Total Tasks</h5>
                    <p class="card-text display-4 fw-bold mb-0 count-up" data-count="{{ $totalTasks }}">0</p>
                    <div class="progress mt-3 bg-white bg-opacity-25" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: 70%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-dark text-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-folder2-open me-2"></i>Recent Projects</h5>
                        <button class="btn btn-sm btn-outline-light">View All</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach ($recentProjects as $project)
                        <li class="list-group-item p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $project->title }}</h6>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $project->created_at->format('d M, Y') }}
                                </small>
                            </div>
                            <span class="badge bg-success rounded-pill">Active</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient-dark text-white p-4 border-0">
                    <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Recent Activities</h5>
                </div>
                <div class="card-body p-4">
                    <div class="timeline">
                        <div class="timeline-item pb-4">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">New Project Created</h6>
                                <p class="text-muted mb-0 small">2 hours ago</p>
                            </div>
                        </div>
                        <div class="timeline-item pb-4">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Task Completed</h6>
                                <p class="text-muted mb-0 small">3 hours ago</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">New User Registered</h6>
                                <p class="text-muted mb-0 small">5 hours ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient-dark text-white p-4 border-0">
                    <h5 class="mb-0"><i class="bi bi-lightning-charge me-2"></i>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="{{ route('admin.users.create') }}" 
                            class="btn btn-light border w-100 p-4 rounded-4 text-start"
                            role="button"
                            aria-label="Add a new user">
                             <i class="bi bi-person-plus h3 d-block mb-2 text-primary"></i>
                             Add New User
                         </a>
                         
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.projects.create') }}" 
                               class="btn btn-light border w-100 p-4 rounded-4 text-start"
                               role="button"
                               aria-label="Create a new project">
                                <i class="bi bi-folder-plus h3 d-block mb-2 text-success"></i>
                                Create Project
                            </a>
                        </div>
                        
                        <div class="col-6">
                            <a href="{{ route('admin.tasks.create') }}" 
                               class="btn btn-light border w-100 p-4 rounded-4 text-start"
                               role="button"
                               aria-label="Add a new task">
                                <i class="bi bi-plus-square h3 d-block mb-2 text-info"></i>
                                Add Task
                            </a>
                        </div>
                        
                        <div class="col-6">
                            <a href="{{ route('admin.reports.projects') }}" 
                               class="btn btn-light border w-100 p-4 rounded-4 text-start"
                               role="button"
                               aria-label="Generate a report">
                                <i class="bi bi-file-earmark-text h3 d-block mb-2 text-warning"></i>
                                Generate Report
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .bg-gradient-dark {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    }

    .icon-background {
        right: -15px;
        bottom: -15px;
        transform: rotate(-15deg);
    }

    .timeline {
        position: relative;
    }

    .timeline-item {
        position: relative;
        padding-left: 30px;
    }

    .timeline-marker {
        position: absolute;
        left: 0;
        top: 0;
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 5px;
        top: 12px;
        bottom: -12px;
        width: 2px;
        background: #e9ecef;
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".count-up").forEach(function(el) {
            let count = parseInt(el.dataset.count);
            let current = 0;
            let increment = count / 50;
            let interval = setInterval(function() {
                current += increment;
                el.textContent = Math.round(current);
                if (current >= count) {
                    el.textContent = count;
                    clearInterval(interval);
                }
            }, 20);
        });
    });
</script>
@endsection
