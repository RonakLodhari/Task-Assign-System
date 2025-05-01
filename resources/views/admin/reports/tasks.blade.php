@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-primary bg-gradient p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white">
                            <i class="bi bi-list-task me-2"></i>Task Reports
                        </h4>
                        <div class="search-box">
                            <div class="position-relative">
                                <input type="text" id="search" class="form-control bg-light border-0 rounded-pill px-4 py-2" 
                                       placeholder="Search tasks..." style="width: 250px;">
                                <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 px-4">ID</th>
                                    <th class="border-0">Task</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Assigned To</th>
                                </tr>
                            </thead>
                            <tbody id="taskTable">
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="px-4">{{ $task->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="bi bi-check2-square text-primary"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0">{{ $task->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill px-3 py-2
                                                @if($task->status === 'Pending') bg-warning
                                                @elseif($task->status === 'In Progress') bg-primary
                                                @else bg-success
                                                @endif">
                                                {{ $task->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($task->assignedUser)
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                                         style="width: 32px; height: 32px;">
                                                        <i class="bi bi-person text-primary"></i>
                                                    </div>
                                                    <span class="ms-2">{{ $task->assignedUser->fullname }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted">Not Assigned</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
</style>

<script>
    document.getElementById("search").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#taskTable tr");
        
        rows.forEach(row => {
            let name = row.querySelector("h6").textContent.toLowerCase();
            let status = row.children[2].textContent.toLowerCase();
            let assignedTo = row.children[3].textContent.toLowerCase();

            if (name.includes(filter) || status.includes(filter) || assignedTo.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>
@endsection
