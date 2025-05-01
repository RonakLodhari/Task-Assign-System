@extends('layouts.user')

@section('content')
<div class="dashboard-modern-bg">
    <div class="dashboard-container">
        <div class="dashboard-top-row">
            <!-- User Welcome Section -->
            <div class="welcome-card glass-card">
                <div class="user-profile">
                    <div class="profile-image modern-avatar">
                        <img src="{{ asset(auth()->user()->image ?? 'images/default-avatar.png') }}" alt="Profile">
                    </div>
                    <div class="user-details">
                        <h1>Welcome, <span class="highlight">{{ auth()->user()->fullname }}</span></h1>
                        <p class="role modern-role">{{ ucfirst(auth()->user()->usertype ?? 'User') }}</p>
                        <div class="login-info">
                            <span><i class="fas fa-sign-in-alt"></i> Last Login: {{ auth()->user()->login_time ? auth()->user()->login_time->format('d M Y, h:i A') : 'Never' }}</span>
                            <span><i class="fas fa-sign-out-alt"></i> Last Logout: {{ auth()->user()->logout_time ? auth()->user()->logout_time->format('d M Y, h:i A') : 'Never' }}</span>
                        </div>
                    </div>
                </div>
                <div class="current-time modern-time">
                    <i class="far fa-clock"></i>
                    <span id="liveClock"></span>
                </div>
            </div>
            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card projects glass-card">
                    <div class="stat-icon modern-icon projects">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Total Projects</h3>
                        <div class="stat-number">{{ auth()->user()->assignedProjects->count() }}</div>
                    </div>
                </div>
                <div class="stat-card tasks glass-card">
                    <div class="stat-icon modern-icon tasks">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Completed Tasks</h3>
                        <div class="stat-number">{{ auth()->user()->assignedTasks->where('status', 'Completed')->count() }}</div>
                    </div>
                </div>
                <div class="stat-card performance glass-card">
                    <div class="stat-icon modern-icon performance">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Performance</h3>
                        <div class="progress-container">
                            @php
                                $totalTasks = auth()->user()->assignedTasks->count();
                                $completedTasks = auth()->user()->assignedTasks->where('status', 'Completed')->count();
                                $percentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
                            @endphp
                            <div class="progress modern-progress">
                                <div class="progress-bar modern-progress-bar" style="width: {{ $percentage }}%">
                                    <span>{{ $percentage }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects and Tasks Section -->
        <div class="dashboard-grid">
            <div class="info-card glass-card">
                <div class="card-header">
                    <h2><i class="fas fa-folder-open"></i> Recent Projects</h2>
                </div>
                <div class="card-content">
                    @forelse(auth()->user()->assignedProjects->sortByDesc('created_at')->take(4) as $project)
                        <div class="recent-project-item d-flex align-items-center justify-content-between mb-3 p-3 rounded shadow-sm">
                            <div class="d-flex align-items-center gap-3">
                                <div class="recent-project-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <div>
                                    <div class="recent-project-title fw-bold">{{ $project->title }}</div>
                                    <div class="recent-project-date text-muted small">
                                        <i class="far fa-calendar-alt"></i>
                                        {{ $project->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                            <span class="status-badge modern-badge {{ strtolower(str_replace(' ', '', $project->status)) }}">
                                {{ $project->status }}
                            </span>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-folder-open"></i>
                            <p>No projects assigned yet</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="info-card glass-card">
                <div class="card-header">
                    <h2><i class="fas fa-calendar-alt"></i> Upcoming Deadlines</h2>
                </div>
                <div class="card-content">
                    @forelse(auth()->user()->assignedTasks->where('status', '!=', 'Completed')->sortBy('due_date')->take(4) as $task)
                        <div class="list-item modern-list-item">
                            <div class="item-info"> 
                                
                                <h4>{{ $task->name }}</h4>
                                <p class="deadline">Due: {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</p>
                            </div>
                            <span class="status-badge modern-badge {{ strtolower(str_replace(' ', '', $task->status)) }}">
                                {{ $task->status }}
                            </span>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-calendar-check"></i>
                            <p>No upcoming deadlines</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
body {
    font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
    background: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
    min-height: 100vh;
}
.dashboard-modern-bg {
    min-height: 100vh;
    padding: 32px 0;
    background: transparent;
}
.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 32px 24px;
}
.dashboard-top-row {
    display: flex;
    gap: 32px;
    align-items: flex-start;
    margin-bottom: 32px;
    flex-wrap: wrap;
}
.welcome-card {
    flex: 2;
    min-width: 340px;
    margin-bottom: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 32px 24px;
    background: rgba(255,255,255,0.85);
    border-radius: 24px;
    box-shadow: 0 4px 24px rgba(59,130,246,0.10);
    position: relative;
}
.current-time.modern-time {
    margin-left: 32px;
    font-size: 1.3rem;
    color: #22223b;
    background: linear-gradient(90deg, #6366f1 10%, #a5b4fc 100%);
    color: #fff;
    padding: 18px 32px;
    border-radius: 14px;
    box-shadow: 0 2px 8px rgba(99,102,241,0.07);
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
}
.stats-grid {
    flex: 1.5;
    display: flex;
    flex-direction: column;
    gap: 18px;
    min-width: 260px;
}
.stat-card {
    padding: 22px 18px;
    display: flex;
    align-items: center;
    gap: 18px;
    border-radius: 18px;
    background: rgba(255,255,255,0.85);
    box-shadow: 0 2px 16px rgba(99,102,241,0.07);
    transition: transform 0.2s, box-shadow 0.2s;
}
.stat-card:hover {
    transform: translateY(-6px) scale(1.03);
    box-shadow: 0 8px 32px rgba(99,102,241,0.13);
}
.stat-icon.modern-icon {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.7rem;
    background: linear-gradient(135deg, #6366f1 60%, #a5b4fc 100%);
    color: #fff;
    box-shadow: 0 2px 8px rgba(99,102,241,0.10);
}
.stat-icon.projects { background: linear-gradient(135deg, #22d3ee 60%, #6366f1 100%); }
.stat-icon.tasks { background: linear-gradient(135deg, #fbbf24 60%, #6366f1 100%); }
.stat-icon.performance { background: linear-gradient(135deg, #34d399 60%, #6366f1 100%); }
.stat-details h3 {
    font-size: 1.05rem;
    color: #6366f1;
    margin-bottom: 4px;
    font-weight: 600;
}
.stat-number {
    font-size: 1.7rem;
    font-weight: 700;
    color: #22223b;
}
.progress-container {
    width: 100%;
    margin-top: 8px;
}
.progress.modern-progress {
    height: 20px;
    background: #e0e7ff;
    border-radius: 10px;
    overflow: hidden;
    margin-top: 2px;
}
.progress-bar.modern-progress-bar {
    background: linear-gradient(90deg, #6366f1 60%, #22d3ee 100%);
    height: 100%;
    border-radius: 8px;
    position: relative;
    transition: width 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    font-size: 0.95rem;
    color: #fff;
    font-weight: 600;
    padding-right: 10px;
}
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
    gap: 32px;
}
.info-card {
    border-radius: 18px;
    overflow: hidden;
    background: rgba(255,255,255,0.85);
    box-shadow: 0 2px 16px rgba(99,102,241,0.07);
}
.card-header {
    padding: 18px 22px;
    background: rgba(99,102,241,0.07);
    border-bottom: 1px solid #e0e7ff;
}
.card-header h2 {
    font-size: 1.15rem;
    color: #22223b;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 700;
}
.card-content {
    padding: 18px 22px;
}
.list-item.modern-list-item {
    padding: 14px 0;
    border-bottom: 1px solid #e0e7ff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background 0.2s;
    border-radius: 10px;
}
.list-item.modern-list-item:hover {
    background: #f3f4f6;
}
.list-item:last-child {
    border-bottom: none;
}
.item-info h4 {
    margin: 0;
    color: #22223b;
    font-size: 1.05rem;
    font-weight: 600;
}
.deadline {
    font-size: 0.93rem;
    color: #6366f1;
    margin: 4px 0 0 0;
}
.status-badge.modern-badge {
    padding: 6px 16px;
    border-radius: 14px;
    font-size: 0.98rem;
    font-weight: 600;
    letter-spacing: 0.02em;
    background: #f1f5f9;
    color: #6366f1;
    border: 1px solid #6366f1;
    margin-left: 10px;
    box-shadow: 0 1px 4px rgba(99,102,241,0.07);
}
.status-badge.modern-badge.completed {
    background: #dcfce7;
    color: #22c55e;
    border-color: #22c55e;
}
.status-badge.modern-badge.pending {
    background: #fef9c3;
    color: #eab308;
    border-color: #eab308;
}
.status-badge.modern-badge.inprogress, .status-badge.modern-badge.in-progress {
    background: #dbeafe;
    color: #2563eb;
    border-color: #2563eb;
}
.empty-state {
    text-align: center;
    padding: 28px 0;
    color: #6366f1;
}
.empty-state i {
    font-size: 2rem;
    margin-bottom: 8px;
    color: #a5b4fc;
}
@media (max-width: 1100px) {
    .dashboard-top-row {
        flex-direction: column;
        gap: 24px;
    }
    .stats-grid {
        flex-direction: row;
        gap: 18px;
        min-width: unset;
    }
}
@media (max-width: 900px) {
    .dashboard-container {
        padding: 12px 2vw;
    }
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    .stats-grid {
        flex-direction: column;
        gap: 18px;
    }
    .user-profile {
        flex-direction: column;
        gap: 18px;
        text-align: center;
    }
    .current-time.modern-time {
        margin: 18px 0 0 0;
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
    function updateClock() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit', 
            minute: '2-digit',
            second: '2-digit'
        };
        document.getElementById('liveClock').textContent = now.toLocaleDateString('en-US', options);
    }
    
    updateClock();
    setInterval(updateClock, 1000);
</script>
@endsection
