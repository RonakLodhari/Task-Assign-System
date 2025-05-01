@extends('layouts.user')

@section('content')
<div class="updates-container">
    <div class="updates-header-modern">
        <div class="header-title-modern">
            <h2><i class="bi bi-journal-text"></i> My Updates</h2>
            <p class="text-muted">Track and manage your project updates</p>
        </div>
        <a href="{{ route('user.updates.create') }}" class="btn-create-modern">
            <i class="bi bi-plus-circle"></i> Create New Update
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($updates->isEmpty())
        <div class="empty-state">
            <i class="bi bi-journal-x display-4"></i>
            <h3>No Updates Yet</h3>
            <p>Start tracking your progress by creating your first update</p>
            <a href="{{ route('user.updates.create') }}" class="btn-create-empty">
                Create Your First Update
            </a>
        </div>
    @else
        <div class="updates-grid-modern">
            @foreach($updates->sortByDesc('created_at') as $update)
                <div class="update-card-modern">
                    <div class="card-header-modern">
                        <h5>{{ $update->title }}</h5>
                        <span class="status-badge-modern {{ strtolower($update->status) }}">
                            {{ ucfirst($update->status) }}
                        </span>
                    </div>
                    <div class="card-body-modern">
                        <p class="description-modern">{{ Str::limit($update->description, 100) }}</p>
                        <div class="meta-info-modern">
                            @if($update->project)
                                <span><i class="bi bi-folder"></i> {{ $update->project->title }}</span>
                            @endif
                            <span><i class="bi bi-clock"></i> {{ $update->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                    <div class="card-actions-modern">
                        <button class="btn-view-modern" data-bs-toggle="modal" data-bs-target="#updateModal{{ $update->id }}">
                            View Details
                        </button>
                        <a href="{{ route('user.updates.edit', $update->id) }}" class="btn-edit-modern">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </div>
                </div>

                <!-- Modal remains unchanged -->
                <div class="modal fade" id="updateModal{{ $update->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Info</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Title:</strong> {{ $update->title }}</p>
                                <p><strong>Description:</strong> {{ $update->description }}</p>
                                <p><strong>Project:</strong> {{ optional($update->project)->title ?? 'N/A' }}</p>
                                <p><strong>Task:</strong> {{ optional($update->task)->name ?? 'N/A' }}</p>
                                <p><strong>Status:</strong> 
                                    <span class="badge bg-{{ $update->status == 'Pending' ? 'warning' : ($update->status == 'Reviewed' ? 'info' : 'danger') }}">
                                        {{ ucfirst($update->status) }}
                                    </span>
                                </p>
                                <p><strong>Other:</strong> {{ $update->other ?? 'N/A' }}</p>
                                <p><strong>Created At:</strong> {{ $update->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('user.updates.edit', $update->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
.updates-container {
    padding: 32px 0;
    max-width: 1200px;
    margin: 0 auto;
    background: #f4f7fb;
    min-height: 100vh;
}
.updates-header-modern {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 32px;
    padding: 0 24px;
}
.header-title-modern h2 {
    font-size: 2rem;
    font-weight: 800;
    color: #22223b;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 0;
}
.header-title-modern p {
    color: #64748b;
    margin-bottom: 0;
    font-size: 1rem;
}
.btn-create-modern {
    background: linear-gradient(90deg, #6366f1 60%, #0ea5e9 100%);
    color: #fff;
    padding: 12px 28px;
    border-radius: 10px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    font-size: 1.05rem;
    box-shadow: 0 2px 8px rgba(59,130,246,0.10);
    transition: background 0.2s, transform 0.2s;
    border: none;
}
.btn-create-modern:hover {
    background: linear-gradient(90deg, #0ea5e9 60%, #6366f1 100%);
    transform: translateY(-2px) scale(1.03);
}
.updates-grid-modern {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 32px;
    padding: 0 24px 32px 24px;
}
.update-card-modern {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 8px 32px rgba(59,130,246,0.10);
    border-left: 6px solid #6366f1;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.2s, transform 0.2s;
    min-width: 0;
    overflow: hidden;
}
.update-card-modern:hover {
    box-shadow: 0 12px 40px rgba(99,102,241,0.13);
    transform: translateY(-4px) scale(1.025);
}
.card-header-modern {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 22px 26px 0 26px;
}
.card-header-modern h5 {
    margin: 0;
    font-size: 1.13rem;
    font-weight: 700;
    color: #22223b;
    max-width: 180px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
}
.status-badge-modern {
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
.status-badge-modern.pending {
    background: #fef9c3;
    color: #eab308;
    border-color: #eab308;
}
.status-badge-modern.reviewed {
    background: #dbeafe;
    color: #2563eb;
    border-color: #2563eb;
}
.status-badge-modern.completed {
    background: #dcfce7;
    color: #22c55e;
    border-color: #22c55e;
}
.card-body-modern {
    padding: 14px 26px 0 26px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.description-modern {
    color: #475569;
    font-size: 1.04rem;
    margin-bottom: 4px;
    min-height: 38px;
}
.meta-info-modern {
    display: flex;
    gap: 18px;
    color: #64748b;
    font-size: 0.99rem;
    margin-bottom: 8px;
}
.meta-info-modern i {
    color: #6366f1;
    margin-right: 6px;
}
.card-actions-modern {
    padding: 18px 26px 22px 26px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
}
.btn-view-modern {
    background: linear-gradient(90deg, #6366f1 60%, #0ea5e9 100%);
    color: #fff;
    border: none;
    padding: 10px 0;
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
    text-decoration: none;
}
.btn-view-modern:hover {
    background: linear-gradient(90deg, #0ea5e9 60%, #6366f1 100%);
    transform: translateY(-2px) scale(1.04);
}
.btn-edit-modern {
    color: #6366f1;
    background: #eef2ff;
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 1.1rem;
    transition: background 0.2s, color 0.2s;
    text-decoration: none;
    display: flex;
    align-items: center;
    border: none;
}
.btn-edit-modern:hover {
    background: #6366f1;
    color: #fff;
}
.empty-state {
    text-align: center;
    padding: 48px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin: 32px 24px;
}
.empty-state i {
    color: #9ca3af;
    margin-bottom: 16px;
}
.empty-state h3 {
    margin-bottom: 8px;
    color: #111827;
}
.empty-state p {
    color: #6b7280;
    margin-bottom: 24px;
}
.btn-create-empty {
    background: #6366f1;
    color: white;
    padding: 10px 24px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 600;
}
.btn-create-empty:hover {
    background: #0ea5e9;
}
@media (max-width: 900px) {
    .updates-header-modern {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
        padding: 0 12px;
    }
    .updates-grid-modern {
        grid-template-columns: 1fr;
        gap: 18px;
        padding: 0 8px 24px 8px;
    }
}
/* Modern Modal Styles */
.modal-content {
    border-radius: 18px;
    border: none;
    box-shadow: 0 8px 32px rgba(59,130,246,0.13);
    background: #fff;
    padding: 0;
    overflow: hidden;
}
.modal-header {
    border-bottom: 1px solid #e5e7eb;
    padding: 24px 32px 16px 32px;
    background: #f4f7fb;
    border-top-left-radius: 18px;
    border-top-right-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.modal-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #22223b;
    letter-spacing: 0.01em;
}
.modal-body {
    padding: 28px 32px 18px 32px;
    background: #fff;
}
.modal-body p {
    margin-bottom: 14px;
    color: #475569;
    font-size: 1.04rem;
}
.modal-body strong {
    color: #22223b;
}
.modal-footer {
    border-top: 1px solid #e5e7eb;
    padding: 18px 32px;
    background: #f4f7fb;
    border-bottom-left-radius: 18px;
    border-bottom-right-radius: 18px;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}
.modal .badge {
    padding: 6px 18px;
    border-radius: 16px;
    font-size: 0.98rem;
    font-weight: 600;
    letter-spacing: 0.02em;
}
.modal .badge.bg-warning {
    background: #fef9c3;
    color: #eab308;
    border: 1px solid #eab308;
}
.modal .badge.bg-info {
    background: #dbeafe;
    color: #2563eb;
    border: 1px solid #2563eb;
}
.modal .badge.bg-danger {
    background: #fee2e2;
    color: #dc2626;
    border: 1px solid #dc2626;
}
.modal .btn {
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    padding: 10px 22px;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 8px rgba(59,130,246,0.07);
}
.modal .btn-warning {
    background: linear-gradient(90deg, #6366f1 60%, #0ea5e9 100%);
    color: #fff;
    border: none;
}
.modal .btn-warning:hover {
    background: linear-gradient(90deg, #0ea5e9 60%, #6366f1 100%);
    color: #fff;
}
.modal .btn-outline-secondary {
    border: 1px solid #cbd5e1;
    color: #22223b;
    background: #fff;
}
.modal .btn-outline-secondary:hover {
    background: #f1f5f9;
    color: #6366f1;
    border-color: #6366f1;
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
@media (max-width: 600px) {
    .modal-header, .modal-body, .modal-footer {
        padding-left: 14px;
        padding-right: 14px;
    }
}
</style>
@endsection



