@extends('layouts.user')

@section('content')
<div class="tasks-wrapper">
    <div class="tasks-header">
        <div class="header-content">
            <h1><i class="fas fa-tasks"></i> Your Tasks</h1>
            <p class="text-muted">Manage and track your assigned tasks</p>
        </div>
        <div class="header-actions">
            <div class="search-box modern-search">
                <i class="fas fa-search"></i>
                <input type="text" id="taskSearch" placeholder="Search tasks...">
            </div>
        </div>
    </div>

    <div class="task-list">
        @forelse($tasks as $task)
            <div class="task-item modern-task-card">
                <div class="task-content">
                    <div class="task-header">
                        <div class="project-avatar">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <h3>{{ $task->title }}</h3>
                    </div>
                    <p class="task-description">{{ $task->description }}</p>
                    <div class="task-meta">
                        <div class="meta-group">
                            <i class="fas fa-project-diagram"></i>
                            <span class="meta-label">Project:</span>
                            <a href="#" class="project-link">{{ $task->project->title }}</a>
                        </div>
                        <div class="meta-group">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="meta-label">Created:</span>
                            <span>{{ $task->created_at ? $task->created_at->format('d M Y') : 'Not set' }}</span>
                        </div>
                        <div class="meta-group">
                            <i class="fas fa-clock"></i>
                            <span class="meta-label">Deadline:</span>
                            <span>{{ $task->completed_at ? $task->completed_at->format('d M Y') : 'Not set' }}</span>
                        </div>  
                    </div>
                </div>
                <div class="task-status">
                    <span class="status-badge modern-badge {{ strtolower(str_replace(' ', '', $task->status)) }}">
                        {{ $task->status }}
                    </span>
                    <button class="btn-details modern-btn" data-bs-toggle="modal" data-bs-target="#taskModal{{ $task->id }}">
                        View Details <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            <!-- Task Details Modal -->
            <div class="modal fade" id="taskModal{{ $task->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $task->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-section">
                                <label><i class="fas fa-info-circle"></i> Description</label>
                                <p>{{ $task->description }}</p>
                            </div>
                            <div class="modal-section">
                                <label><i class="fas fa-project-diagram"></i> Project</label>
                                <p>{{ $task->project->title }}</p>
                            </div>
                            <div class="modal-info-grid">
                                <div class="info-item">
                                    <label><i class="fas fa-calendar-alt"></i> Created</label>
                                    <p>{{ $task->created_at->format('d M Y') }}</p>
                                </div>
                                <div class="info-item">
                                    <label><i class="fas fa-clock"></i> Deadline</label>
                                    <p> {{ $task->completed_at ? $task->completed_at->format('d M Y') : 'Not set' }}</p>
                                </div>
                            </div>
                            <div class="modal-section">
                                <label><i class="fas fa-chart-line"></i> Status</label>
                                <span class="status-badge {{ strtolower($task->status) }}">{{ $task->status }}</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-clipboard-check"></i>
                <h3>No Tasks Found</h3>
                <p>You don't have any tasks assigned yet.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
body {
    font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
    background: linear-gradient(120deg, #f8fafc 60%, #e0e7ff 100%);
}

.tasks-wrapper {
    padding: 32px 24px;
    background: transparent;
}

.tasks-header {
    margin-bottom: 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-content h1 {
    font-size: 2rem;
    color: #1e293b;
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 700;
}

.modern-search {
    background: #fff;
    border-radius: 32px;
    box-shadow: 0 2px 12px rgba(59, 130, 246, 0.08);
    padding: 6px 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.modern-search input {
    border: none;
    outline: none;
    background: transparent;
    font-size: 1rem;
    padding: 6px 0;
    width: 180px;
}

.task-list {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.modern-task-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 6px 24px rgba(59, 130, 246, 0.10);
    padding: 28px 32px;
    border-left: 6px solid #6366f1;
    transition: box-shadow 0.2s, border-color 0.2s;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 24px;
}

.modern-task-card:hover {
    box-shadow: 0 12px 32px rgba(59, 130, 246, 0.18);
    border-left-color: #3b82f6;
}

.task-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 8px;
}

.project-avatar {
    width: 40px;
    height: 40px;
    background: #6366f1;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    box-shadow: 0 2px 8px rgba(99, 102, 241, 0.15);
}

.task-description {
    color: #475569;
    margin-bottom: 16px;
    font-size: 1.08rem;
}

.meta-group {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #64748b;
    font-size: 0.98rem;
}

.meta-group i {
    color: #6366f1;
    font-size: 1rem;
}

.task-status {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 12px;
}

.modern-badge {
    padding: 6px 18px;
    border-radius: 16px;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.02em;
    background: #f1f5f9;
    color: #6366f1;
    border: 1px solid #6366f1;
    margin-bottom: 8px;
}

.modern-badge.completed {
    background: #dcfce7;
    color: #22c55e;
    border-color: #22c55e;
}
.modern-badge.pending {
    background: #fef9c3;
    color: #eab308;
    border-color: #eab308;
}
.modern-badge.inprogress, .modern-badge['in progress'] {
    background: #dbeafe;
    color: #2563eb;
    border-color: #2563eb;
}

.modern-btn {
    background: linear-gradient(90deg, #6366f1 60%, #3b82f6 100%);
    color: #fff;
    border: none;
    padding: 10px 22px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.10);
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.modern-btn:hover {
    background: linear-gradient(90deg, #3b82f6 60%, #6366f1 100%);
    transform: translateY(-2px) scale(1.04);
}

.empty-state {
    text-align: center;
    color: #64748b;
    margin-top: 60px;
}

.empty-state i {
    font-size: 3rem;
    color: #6366f1;
    margin-bottom: 16px;
}

@media (max-width: 700px) {
    .modern-task-card {
        flex-direction: column;
        padding: 18px 10px;
        gap: 12px;
    }
    .tasks-wrapper {
        padding: 12px 2px;
    }
}
</style>

<script>
function openTaskDetails(taskId) {
    const modal = new bootstrap.Modal(document.getElementById('taskModal' + taskId));
    modal.show();
}

document.getElementById('taskSearch').addEventListener('input', function(e) {
    const searchText = e.target.value.toLowerCase();
    const taskCards = document.querySelectorAll('.task-card');
    
    taskCards.forEach(card => {
        const title = card.querySelector('h2').textContent.toLowerCase();
        const description = card.querySelector('.task-description').textContent.toLowerCase();
        
        if (title.includes(searchText) || description.includes(searchText)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>
@endsection
