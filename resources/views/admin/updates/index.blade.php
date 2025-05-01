@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-gradient bg-primary p-4 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-white">
                    <i class="bi bi-clock-history me-2"></i>User Updates
                </h4>
                <div class="search-box">
                    <input type="text" id="updateSearch" class="form-control bg-light border-0 rounded-pill px-4" 
                           placeholder="Search updates..." style="width: 250px;">
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3 rounded-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-4">User</th>
                            <th class="border-0">Title</th>
                            <th class="border-0">Project</th>
                            <th class="border-0">Task</th>
                            <th class="border-0">Status</th>
                            <th class="border-0">Date</th>
                            <th class="border-0">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($updates->sortByDesc('created_at') as $update)
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="bi bi-person text-primary"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ $update->user->fullname }}</h6>
                                            <small class="text-muted">#{{$update->user->id}}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $update->title }}</td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3">
                                        {{ optional($update->project)->title ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">
                                        {{ optional($update->task)->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill px-3 
                                        @if($update->status == 'Pending') bg-warning text-dark
                                        @elseif($update->status == 'Reviewed') bg-success
                                        @elseif($update->status == 'Rejected') bg-danger
                                        @endif">
                                        {{ $update->status }}
                                    </span>
                                </td>
                                <td>{{ $update->created_at->format('M d, Y') }}</td>
                                <td>
                                    <button class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                            data-bs-toggle="modal" data-bs-target="#updateModal{{ $update->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="updateModal{{ $update->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                        <div class="modal-header bg-primary bg-gradient p-4 border-0">
                                            <h5 class="modal-title text-white mb-0">
                                                <i class="bi bi-info-circle me-2"></i>Update Details
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                                                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px;">
                                                    <i class="bi bi-person text-primary h4 mb-0"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h5 class="mb-1">{{ $update->user->fullname }}</h5>
                                                    <div class="d-flex align-items-center text-muted">
                                                        <i class="bi bi-clock me-2"></i>
                                                        {{ $update->created_at->format('M d, Y h:i A') }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card border-0 bg-light rounded-4 mb-4">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-3">{{ $update->title }}</h5>
                                                    <p class="card-text text-muted mb-0">{{ $update->description }}</p>
                                                </div>
                                            </div>

                                            <div class="row g-4">
                                                <div class="col-md-4">
                                                    <div class="card h-100 border-0 bg-info bg-opacity-10 rounded-4">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center mb-3">
                                                                <i class="bi bi-folder2 text-info me-2"></i>
                                                                <h6 class="mb-0 text-info">Project</h6>
                                                            </div>
                                                            <p class="mb-0">{{ optional($update->project)->title ?? 'Not Assigned' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card h-100 border-0 bg-primary bg-opacity-10 rounded-4">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center mb-3">
                                                                <i class="bi bi-list-task text-primary me-2"></i>
                                                                <h6 class="mb-0 text-primary">Task</h6>
                                                            </div>
                                                            <p class="mb-0">{{ optional($update->task)->name ?? 'Not Assigned' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card h-100 border-0 bg-success bg-opacity-10 rounded-4">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center mb-3">
                                                                <i class="bi bi-check-circle text-success me-2"></i>
                                                                <h6 class="mb-0 text-success">Status</h6>
                                                            </div>
                                                            <span class="badge rounded-pill px-3 py-2
                                                                @if($update->status == 'Pending') bg-warning text-dark
                                                                @elseif($update->status == 'Reviewed') bg-success
                                                                @elseif($update->status == 'Rejected') bg-danger
                                                                @endif">
                                                                {{ $update->status }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    box-shadow: none;
    border-color: #dee2e6;
}
.card {
    transition: all 0.3s ease;
}
.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
}
.badge {
    font-weight: 500;
}
.btn-light:hover {
    background-color: #e9ecef;
}
</style>

<script>
document.getElementById('updateSearch').addEventListener('keyup', function() {
    let searchText = this.value.toLowerCase();
    let rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchText) ? '' : 'none';
    });
});
</script>
@endsection
