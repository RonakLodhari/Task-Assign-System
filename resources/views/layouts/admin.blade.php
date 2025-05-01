<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RBL - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100%;
            background: linear-gradient(180deg, #1e40af 0%, #3b82f6 100%);
            padding: 0;
            transition: all 0.3s ease;
            overflow-y: auto;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .logo-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem;
            background: rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }

        .logo-wrapper {
            width: 100px;
            height: 100px;
            background: #000;
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .sidebar h4 {
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            letter-spacing: 1px;
            margin: 5px;
        }

        .sidebar a,
        .dropdown-btn {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            display: flex;
            align-items: center;
            margin: 0.25rem 1rem;
            padding: 0.75rem 1.25rem;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            background: none;
            width: calc(100% - 2rem);
            text-align: left;
            border-radius: 10px;
        }

        .sidebar a i,
        .dropdown-btn i {
            font-size: 1.25rem;
            margin-right: 12px;
            opacity: 0.9;
        }

        .sidebar a:hover,
        .dropdown-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .dropdown-container {
            display: none;
            background: rgba(0, 0, 0, 0.15);
            margin: 0.5rem 1rem;
            border-radius: 10px;
            padding: 0.5rem;
        }

        .dropdown-container a {
            padding: 0.6rem 1rem 0.6rem 3rem;
            margin: 0.25rem 0;
            font-size: 0.9rem;
        }

        .sidebar a.active,
        .dropdown-btn.active {
            background: rgba(255, 255, 255, 0.2);
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-btn .bi-chevron-down {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .dropdown-btn.active .bi-chevron-down {
            transform: rotate(-180deg);
        }

        .content {
            margin-left: 280px;
            padding: 2rem;
            width: calc(100% - 280px);
            min-height: 100vh;
            background: #f8fafc;
            transition: all 0.3s ease;
            border-radius: 20px 0 0 20px;
            box-shadow: -10px 0 20px rgba(0, 0, 0, 0.05);
        }

        .menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            background: white;
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
            font-size: 1.25rem;
            color: #3b82f6;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1001;
        }

        /* Custom Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        @media (max-width: 991px) {
            .sidebar {
                left: -280px;
            }

            .content {
                margin-left: 0;
                width: 100%;
            }

            .menu-toggle {
                display: block;
            }

            .sidebar.active {
                left: 0;
            }

            .content.active {
                margin-left: 280px;
            }
        }
    </style>
</head>

<body>
    <style>
        /* Update existing media queries and add new ones */
        @media (max-width: 1200px) {
            .content {
                padding: 1.5rem;
            }
        }

        @media (max-width: 991px) {
            .sidebar {
                left: -280px;
                box-shadow: none;
            }

            .content {
                margin-left: 0;
                width: 100%;
                border-radius: 0;
            }

            .menu-toggle {
                display: block;
                transition: all 0.3s ease;
            }

            .sidebar.active {
                left: 0;
                box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            }

            .content.active {
                margin-left: 0;
                transform: translateX(280px);
                opacity: 0.8;
            }
        }

        @media (max-width: 768px) {
            .logo-wrapper {
                width: 80px;
                height: 80px;
                padding: 12px;
            }

            .sidebar h4 {
                font-size: 1.1rem;
            }

            .sidebar a,
            .dropdown-btn {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .dropdown-container a {
                padding: 0.5rem 1rem 0.5rem 2.5rem;
            }

            .content {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .logo-wrapper {
                width: 60px;
                height: 60px;
                padding: 8px;
            }

            .sidebar {
                width: 260px;
            }

            .content.active {
                transform: translateX(260px);
            }

            .menu-toggle {
                top: 0.75rem;
                left: 0.75rem;
                padding: 0.4rem;
                font-size: 1.1rem;
            }
        }

        /* Add overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }
    <!-- Add overlay div after sidebar -->
    <div class="sidebar-overlay"></div>

        .sidebar {
            background: #0ea5e9;
        }

        .sidebar-header {
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .logo-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo-wrapper {
            width: 120px;
            height: 120px;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            border-radius: 5px;
        }

        .logo-wrapper img {
            width: 90%;
            height: 90%;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .sidebar-header h4 {
            color: #fff;
            font-size: 1.25rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px; 
            height: 100%;
            background: #0ea5e9;
            padding: 0;  /* Changed padding */
            transition: all 0.3s ease;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0 0.5rem;
        }

        .logo-wrapper img {
            width: 50%;
            height: 50%;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .sidebar-header h4 {
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            margin: 0;
        }
        .img-fluid {
            max-width: 80;
            height: 90px;
            width: 90px;
            margin: 5px;
         
   
        }
        /* Add styles for navigation items */
        .sidebar a, .dropdown-btn {
            padding: 0.75rem 1.5rem;
            margin-top: 0.5rem;
        }
    </style>

    <!-- Fixed HTML structure -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="{{ asset('images/rbl.png') }}" alt="RBL Logo" class="img-fluid">
            <h4>RBL</h4>
        </div>
    <a href="{{ url('/admin/dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>

        <button class="dropdown-btn"><i class="bi bi-people"></i> User Management <i
                class="bi bi-chevron-down ms-auto"></i></button>
        <div class="dropdown-container">
            <a href="{{ url('/admin/users') }}"><i class="bi bi-eye"></i> View Users</a>
            <a href="{{ url('/admin/users/create') }}"><i class="bi bi-person-plus"></i> Add User</a>
        </div>

        <button class="dropdown-btn"><i class="bi bi-folder"></i> Project Management <i
                class="bi bi-chevron-down ms-auto"></i></button>
        <div class="dropdown-container">
            <a href="{{ url('/admin/projects') }}"><i class="bi bi-folder2"></i> All Projects</a>
            <a href="{{ url('/admin/projects/create') }}"><i class="bi bi-folder-plus"></i> Add Project</a>
        </div>

        <button class="dropdown-btn"> <i class="bi bi-list-task"></i> Tasks Management<i
                class="bi bi-chevron-down ms-auto"></i></button>
        <div class="dropdown-container">
            <a href="{{ url('/admin/tasks') }}"><i class="bi bi-list-task"></i> All Tasks</a>
            <a href="{{ url('/admin/tasks/create') }}"><i class="bi bi-plus"></i> Create Task</a>
        </div>

        <button class="dropdown-btn"><i class="bi bi-bar-chart"></i> Reports <i
                class="bi bi-chevron-down ms-auto"></i></button>
        <div class="dropdown-container">
            <a href="{{ url('/admin/reports/users') }}"><i class="bi bi-person-lines-fill"></i> User Reports</a>
            <a href="{{ url('/admin/reports/projects') }}"><i class="bi bi-graph-up"></i> Project Reports</a>
            <a href="{{ url('/admin/reports/tasks') }}"><i class="bi bi-check-circle"></i> Tasks Reports</a>
        </div>

        <a href="{{ url('/admin/settings') }}"><i class="bi bi-gear"></i> Settings</a>
        <a href="{{ route('admin.updates.index') }}"><i class="bi bi-arrow-clockwise"></i> Manage Updates</a>
        
        <a href="{{ url('/admin/logs') }}" onclick="logs()"><i class="bi bi-clock-history"></i> Activity Logs</a>
        <a href="{{ route('admin.discussion.index') }}"><i class="bi bi-chat-dots"></i> Discussion</a>

        <a href="{{ route('admin.logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <button class="menu-toggle"><i class="bi bi-list"></i></button>
    <div class="content">
        @yield('content')
    </div>

    <script>
        document.querySelector(".menu-toggle").addEventListener("click", function() {
            document.querySelector(".sidebar").classList.toggle("active");
            document.querySelector(".content").classList.toggle("active");
        });

        document.querySelectorAll(".sidebar a").forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add("active");

                let parentDropdown = link.closest(".dropdown-container");
                if (parentDropdown) {
                    parentDropdown.style.display = "block";
                    parentDropdown.previousElementSibling.classList.add("active");
                }
            }
        });

        document.querySelectorAll(".dropdown-btn").forEach(button => {
            button.addEventListener("click", function() {
                // Close all other dropdowns first
                const allDropdowns = document.querySelectorAll(".dropdown-container");
                const allDropdownBtns = document.querySelectorAll(".dropdown-btn");
                
                allDropdowns.forEach((dropdown, index) => {
                    if (dropdown !== this.nextElementSibling) {
                        dropdown.style.display = "none";
                        allDropdownBtns[index].classList.remove("active");
                    }
                });

                // Toggle current dropdown
                this.classList.toggle("active");
                let dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        });

        <!-- Update JavaScript -->
        const menuToggle = document.querySelector(".menu-toggle");
        const sidebar = document.querySelector(".sidebar");
        const content = document.querySelector(".content");
        const overlay = document.querySelector(".sidebar-overlay");

        menuToggle.addEventListener("click", function() {
            sidebar.classList.toggle("active");
            content.classList.toggle("active");
            overlay.classList.toggle("active");
        });

        overlay.addEventListener("click", function() {
            sidebar.classList.remove("active");
            content.classList.remove("active");
            overlay.classList.remove("active");
        });

     
    
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
