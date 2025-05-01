@extends('layouts.user')

@section('content')
    <div class="projects-wrapper">
        <div class="projects-header">
            <div class="header-content">
                <h1 class="main-projects-heading">
                    <i class="fas fa-project-diagram"></i>
                    Projects
                </h1>
                <p class="text-muted">Manage and track your project assignments</p>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="projectSearch" placeholder="Search projects...">
                </div>
            </div>
        </div>

        @if ($projects->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h3>No Projects Found</h3>
                <p>You don't have any projects assigned yet.</p>
            </div>
        @else
            <div class="projects-grid">
                @foreach ($projects as $project)
                    <div class="task-style-project-card">
                        <div class="task-style-header">
                            <div class="task-style-icon">
                                <i class="fas fa-folder"></i>
                            </div>
                            <div class="task-style-title-group">
                                <span class="task-style-title">{{ $project->title }}</span>
                                <span class="status-badge task-style-status {{ strtolower(str_replace(' ', '-', $project->status)) }}">
                                    {{ $project->status }}
                                </span>
                            </div>
                        </div>
                        <div class="task-style-body">
                            <div class="task-style-desc">
                                {{ Str::limit($project->description, 100) }}
                            </div>
                            <div class="task-style-meta">
                                <span><i class="fas fa-tasks"></i> {{ $project->tasks()->count() ?? 0 }} Tasks</span>
                                <span><i class="far fa-clock"></i> {{ $project->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="task-style-progress">
                                <div class="progress-label">
                                    <span>Progress</span>
                                    <span>{{ $project->progress ?? 0 }}%</span>
                                </div>
                                <div class="task-style-progress-bar-bg">
                                    <div class="task-style-progress-bar" style="width: {{ $project->progress ?? 0 }}%"></div>
                                </div>
                            </div>
                            <div class="task-style-actions">
                                <a href="#" class="task-style-btn-view" data-bs-toggle="modal" data-bs-target="#projectModal{{ $project->id }}">
                                    View Details <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title-group">
                                        <h5 class="modal-title">{{ $project->title }}</h5>
                                        <span class="status-badge {{ strtolower(str_replace(' ', '-', $project->status)) }}">
                                            {{ $project->status }}
                                        </span>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="info-group">
                                        <label><i class="fas fa-info-circle"></i> Description</label>
                                        <p>{{ $project->description }}</p>
                                    </div>
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <label><i class="fas fa-calendar-plus"></i> Created</label>
                                            <p>{{ $project->created_at->format('d M Y') }}</p>
                                        </div>
                                        <div class="info-item">
                                            <label><i class="fas fa-calendar-check"></i> Last Updated</label>
                                            <p>{{ $project->updated_at->format('d M Y') }}</p>
                                        </div>
                                        <!-- Add this block for End Date -->
                                        <div class="info-item">
                                            <label><i class="fas fa-calendar-day"></i> End Date</label>
                                            <p>
                                                @if($project->end_date)
                                                    {{ $project->end_date->format('d M Y') }}
                                                @else
                                                    Not Set
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="info-group">
                                        <label><i class="fas fa-chart-line"></i> Progress</label>
                                        <div class="progress mt-2">
                                            <div class="progress-bar" style="width: {{ $project->progress ?? 0 }}%">
                                                {{ $project->progress ?? 0 }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        /* General Styles */
        .projects-wrapper {
            padding: 30px;
            background: #f8f9fa;
            min-height: calc(100vh - 60px);
        }

        .projects-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e9ecef;
        }

        .header-content h1 {
            font-size: 2.1rem;
            font-weight: 800;
            color: #22223b;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 0;
            margin-top: 0;
            letter-spacing: -1px;
        }

        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 40px;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            background: white;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            border-color: #009ef7;
            box-shadow: 0 0 0 3px rgba(0, 158, 247, 0.1);
            outline: none;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 32px;
            margin-top: 32px;
            justify-content: center;
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
        }

        .task-style-project-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(59,130,246,0.10);
            border-left: 6px solid #6366f1;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.2s, transform 0.2s;
            padding: 0;
            min-width: 0;
        }

        .task-style-project-card:hover {
            box-shadow: 0 12px 40px rgba(99,102,241,0.13);
            transform: translateY(-4px) scale(1.025);
        }

        .task-style-header {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 26px 28px 0 28px;
        }

        .task-style-icon {
            width: 44px;
            height: 44px;
            background: #eef2ff;
            color: #6366f1;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 2px 8px rgba(99,102,241,0.07);
        }

        .task-style-title-group {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex: 1;
            gap: 18px;
        }

        .task-style-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #22223b;
            letter-spacing: 0.01em;
            display: -webkit-box;
            -webkit-line-clamp: 2;      /* Show up to 2 lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            max-width: 180px;           /* Adjust as needed for your card width */
            min-height: 2.5em;          /* Reserve space for 2 lines */
        }

        .task-style-status {
            padding: 6px 18px;
            border-radius: 16px;
            font-size: 0.98rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            background: #f1f5f9;
            color: #6366f1;
            border: 1px solid #6366f1;
            margin-left: 10px;
        }

        .task-style-status.completed {
            background: #dcfce7;
            color: #22c55e;
            border-color: #22c55e;
        }

        .task-style-status.pending {
            background: #fef9c3;
            color: #eab308;
            border-color: #eab308;
        }

        .task-style-status.in-progress {
            background: #dbeafe;
            color: #2563eb;
            border-color: #2563eb;
        }

        .task-style-body {
            padding: 18px 28px 24px 28px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .task-style-desc {
            color: #475569;
            font-size: 1.04rem;
            margin-bottom: 4px;
            min-height: 38px;
        }

        .task-style-meta {
            display: flex;
            gap: 18px;
            color: #64748b;
            font-size: 0.99rem;
            margin-bottom: 8px;
        }

        .task-style-meta i {
            color: #6366f1;
            margin-right: 6px;
        }

        .task-style-progress {
            margin-bottom: 10px;
        }

        .task-style-progress-bar-bg {
            width: 100%;
            height: 12px;
            background: #e0e7ff;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 4px;
        }

        .task-style-progress-bar {
            background: linear-gradient(90deg, #6366f1 60%, #22d3ee 100%);
            height: 100%;
            border-radius: 8px;
            transition: width 0.3s ease;
        }

        .task-style-btn-view {
            background: linear-gradient(90deg, #6366f1 60%, #3b82f6 100%);
            color: #fff;
            border: none;
            padding: 13px 0;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(59,130,246,0.10);
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 12px;
            text-decoration: none;
        }

        .task-style-btn-view:hover {
            background: linear-gradient(90deg, #3b82f6 60%, #6366f1 100%);
            transform: translateY(-2px) scale(1.04);
        }

        @media (max-width: 900px) {
            .projects-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .task-style-header,
            .task-style-body {
                padding-left: 18px;
                padding-right: 18px;
            }
        }
    </style>
@endsection
