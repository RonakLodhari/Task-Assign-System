@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4 fw-bold">Edit User</h2>
        <div class="card shadow-lg p-4 border-0 rounded-3">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" name="fullname"
                            class="form-control shadow-sm @error('fullname') is-invalid @enderror"
                            value="{{ old('fullname', $user->fullname) }}" required>
                        @error('fullname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email"
                            class="form-control shadow-sm @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Phone</label>
                        <input type="number" name="phone"
                            class="form-control shadow-sm @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $user->phone) }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Address</label>
                        <textarea name="address" class="form-control shadow-sm @error('address') is-invalid @enderror" required>{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Role</label>
                        <select name="role" class="form-select shadow-sm">
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">User Type</label>
                        <select name="usertype" id="usertype" class="form-select shadow-sm">
                            <option value="employee" {{ $user->usertype == 'employee' ? 'selected' : '' }}>Employee
                            </option>
                            <option value="manager" {{ $user->usertype == 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="SEO" {{ $user->usertype == 'SEO' ? 'selected' : '' }}>SEO</option>
                            <option value="frontend developer"
                                {{ $user->usertype == 'frontend developer' ? 'selected' : '' }}>Frontend Developer</option>
                            <option value="backend developer"
                                {{ $user->usertype == 'backend developer' ? 'selected' : '' }}>Backend Developer</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Frontend Languages (Multi-select) -->
                    <div class="col-md-6 mb-3" id="frontend_languages_section" style="display: none;">
                        <label class="form-label fw-bold">Frontend Languages</label>
                        <select name="frontend_languages[]" class="form-select shadow-sm" multiple>
                            <option value="HTML" {{ in_array('HTML', json_decode($user->frontend_languages ?? '[]', true)) ? 'selected' : '' }}>HTML</option>
                            <option value="CSS" {{ in_array('CSS', json_decode($user->frontend_languages ?? '[]', true)) ? 'selected' : '' }}>CSS</option>
                            <option value="JavaScript" {{ in_array('JavaScript', json_decode($user->frontend_languages ?? '[]', true)) ? 'selected' : '' }}>JavaScript</option>
                            <option value="React" {{ in_array('React', json_decode($user->frontend_languages ?? '[]', true)) ? 'selected' : '' }}>React</option>
                            <option value="Vue" {{ in_array('Vue', json_decode($user->frontend_languages ?? '[]', true)) ? 'selected' : '' }}>Vue</option>
                        </select>
                        <small class="text-muted">Hold Ctrl (Windows) / Command (Mac) to select multiple options.</small>
                    </div>
                
                    <!-- Backend Languages (Multi-select) -->
                    <div class="col-md-6 mb-3" id="backend_languages_section" style="display: none;">
                        <label class="form-label fw-bold">Backend Languages</label>
                        <select name="backend_languages[]" class="form-select shadow-sm" multiple>
                            <option value="PHP" {{ in_array('PHP', json_decode($user->backend_languages ?? '[]', true)) ? 'selected' : '' }}>PHP</option>
                            <option value="Laravel" {{ in_array('Laravel', json_decode($user->backend_languages ?? '[]', true)) ? 'selected' : '' }}>Laravel</option>
                            <option value="Node.js" {{ in_array('Node.js', json_decode($user->backend_languages ?? '[]', true)) ? 'selected' : '' }}>Node.js</option>
                            <option value="Python" {{ in_array('Python', json_decode($user->backend_languages ?? '[]', true)) ? 'selected' : '' }}>Python</option>
                            <option value="Django" {{ in_array('Django', json_decode($user->backend_languages ?? '[]', true)) ? 'selected' : '' }}>Django</option>
                        </select>
                        <small class="text-muted">Hold Ctrl (Windows) / Command (Mac) to select multiple options.</small>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Date of Birth</label>
                        <input type="date" name="dob"
                            class="form-control shadow-sm @error('dob') is-invalid @enderror"
                            value="{{ old('dob', $user->dob) }}" required>
                        @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 text-center">
                    <label class="form-label fw-bold">Profile Image</label>
                    <div>
                        @if ($user->image)
                            <img id="imagePreview" src="{{ asset($user->image) }}" alt="User Image"
                                class="rounded-circle shadow" width="120">
                        @endif
                    </div>
                    <input type="file" name="image" class="form-control mt-3 shadow-sm" id="imageInput">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">
                        <i class="bi bi-save"></i>
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4 shadow-sm">
                        <i class="bi bi-x-lg"></i> 
                    </a>
                </div>
                
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let usertype = document.getElementById("usertype");
            let frontendSection = document.getElementById("frontend_languages_section");
            let backendSection = document.getElementById("backend_languages_section");
            let imageInput = document.getElementById("imageInput");
            let imagePreview = document.getElementById("imagePreview");

            function toggleFields() {
                frontendSection.style.display = usertype.value === "frontend developer" ? "block" : "none";
                backendSection.style.display = usertype.value === "backend developer" ? "block" : "none";
            }

            function previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (imagePreview) {
                            imagePreview.src = e.target.result;
                        }
                    };
                    reader.readAsDataURL(file);
                }
            }

            usertype.addEventListener("change", toggleFields);
            imageInput.addEventListener("change", previewImage);
            toggleFields();
        });
    </script>
@endsection
