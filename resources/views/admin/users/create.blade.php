@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4 animate__animated animate__fadeInDown">Add New User</h2>
        <div class="card shadow-lg p-4 rounded bg-light animate__animated animate__fadeInUp">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" name="fullname" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" id="dob" required>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div> 

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Address</label>
                        <textarea name="address" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">User Type</label>
                        <select name="usertype" class="form-select" id="usertype" required>
                            <option value="" selected disabled>Select User Type</option>
                            <option value="employee">Employee</option>
                            <option value="manager">Manager</option>
                            <option value="SEO">SEO</option>
                            <option value="frontend developer">Frontend Developer</option>
                            <option value="backend developer">Backend Developer</option>
                            <option value="fullstack developer">Fullstack Developer</option>
                            <option value="mobile developer">Mobile Developer</option>
                            <option value="devops">DevOps</option>
                            <option value="designer">Designer</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3" id="frontend_languages_div" style="display: none;">
                    <label class="form-label fw-bold">Frontend Languages</label>
                    <select name="frontend_languages[]" class="form-select" multiple>
                        <option value="HTML">HTML</option>
                        <option value="CSS">CSS</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="React">React</option>
                        <option value="Vue">Vue</option>
                        <option value="Angular">Angular</option>
                        <option value="Svelte">Svelte</option>
                        <option value="TypeScript">TypeScript</option>
                        <option value="Next.js">Next.js</option>
                        <option value="Nuxt.js">Nuxt.js</option>
                        <option value="Flutter">Flutter</option>
                        <option value="Bootstrap">Bootstrap</option>
                        <option value="Tailwind CSS">Tailwind CSS</option>
                    </select>
                </div>

                <div class="mt-3" id="backend_languages_div" style="display: none;">
                    <label class="form-label fw-bold">Backend Languages</label>
                    <select name="backend_languages[]" class="form-select" multiple>
                        <option value="PHP">PHP</option>
                        <option value="Laravel">Laravel</option>
                        <option value="Node.js">Node.js</option>
                        <option value="Express.js">Express.js</option>
                        <option value="Python">Python</option>
                        <option value="Django">Django</option>
                        <option value="Flask">Flask</option>
                        <option value="Java">Java</option>
                        <option value="Spring Boot">Spring Boot</option>    
                        <option value="C#">C#</option>
                        <option value=".NET">.NET</option>
                        <option value="Ruby">Ruby</option>
                        <option value="Rails">Rails</option>
                        <option value="Go">Go</option>
                        <option value="Kotlin">Kotlin</option>
                        <option value="Scala">Scala</option>
                        <option value="Firebase">Firebase</option>
                        <option value="MySQL">MySQL</option>
                        <option value="PostgreSQL">PostgreSQL</option>
                        <option value="MongoDB">MongoDB</option>
                    </select>
                </div>

                <div class="mt-3">
                    <label class="form-label fw-bold">Profile Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg shadow-sm animate__animated animate__pulse">    
                        <i class="bi bi-check-lg"></i>
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-lg shadow-sm animate__animated animate__pulse">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('usertype').addEventListener('change', function() {
            let userType = this.value;
            // Show both for fullstack, frontend, backend, and mobile developer
            if (userType === 'frontend developer' || userType === 'fullstack developer' || userType === 'mobile developer') {
                document.getElementById('frontend_languages_div').style.display = 'block';
            } else {
                document.getElementById('frontend_languages_div').style.display = 'none';
            }
            if (userType === 'backend developer' || userType === 'fullstack developer' || userType === 'mobile developer') {
                document.getElementById('backend_languages_div').style.display = 'block';
            } else {
                document.getElementById('backend_languages_div').style.display = 'none';
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            let today = new Date().toISOString().split("T")[0];
            document.getElementById("dob").setAttribute("max", today);
        });
    </script>
@endsection
