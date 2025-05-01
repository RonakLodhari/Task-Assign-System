@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-primary bg-gradient p-4 border-0">
                    <h4 class="mb-0 text-white">
                        <i class="bi bi-gear me-2"></i>System Settings
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card h-100 border-0 bg-light rounded-4">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">
                                            <i class="bi bi-building text-primary me-2"></i>Company Details
                                        </h5>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Company Name</label>
                                            <input type="text" name="company_name" class="form-control border-0" 
                                                   value="{{ $settings->company_name ?? '' }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="company_email" class="form-control border-0" 
                                                   value="{{ $settings->company_email ?? '' }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" name="company_phone" class="form-control border-0" 
                                                   value="{{ $settings->company_phone ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card h-100 border-0 bg-light rounded-4">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">
                                            <i class="bi bi-envelope text-primary me-2"></i>Notification Settings
                                        </h5>
                                        
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="email_notifications" 
                                                       {{ $settings->email_notifications ?? false ? 'checked' : '' }}>
                                                <label class="form-check-label">Email Notifications</label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="task_reminders" 
                                                       {{ $settings->task_reminders ?? false ? 'checked' : '' }}>
                                                <label class="form-check-label">Task Reminders</label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="project_updates" 
                                                       {{ $settings->project_updates ?? false ? 'checked' : '' }}>
                                                <label class="form-check-label">Project Updates</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card border-0 bg-light rounded-4">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">
                                            <i class="bi bi-shield-check text-primary me-2"></i>Security Settings
                                        </h5>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="two_factor_auth" 
                                                               {{ $settings->two_factor_auth ?? false ? 'checked' : '' }}>
                                                        <label class="form-check-label">Two-Factor Authentication</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="login_notification" 
                                                               {{ $settings->login_notification ?? false ? 'checked' : '' }}>
                                                        <label class="form-check-label">Login Notifications</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-save me-2"></i>Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus, .form-check-input:focus {
    box-shadow: none;
    border-color: #dee2e6;
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
.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
</style>
@endsection
