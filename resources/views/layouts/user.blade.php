<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RBL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #00b894;
        }
        
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        
        .sidebar {
            background: var(--primary-color);
            min-height: 100vh;
            color: white;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }
        
        .logo-container {
            padding: 25px;
            text-align: center;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logo-container img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 15px;
            filter: drop-shadow(0 0 5px rgba(0,0,0,0.3));
        }
        
        .logo-container h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
            color: var(--accent-color);
        }
        
        .nav-link {
            color: #ecf0f1 !important;
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            font-size: 0.95rem;
        }
        
        .nav-link:hover, .nav-link.active {
            background: var(--accent-color);
            transform: translateX(5px);
        }
        
        .main-content {
            margin-left: 250px;
            background: #f8f9fa;
            min-height: 100vh;
            padding: 30px;
            width: calc(100% - 250px);
        }
        
        /* Add these new styles */
        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s;
            border: 1px solid rgba(0,0,0,0.05);
            width: 100%;
        }
        
        .row {
            margin-right: 0;
            margin-left: 0;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="logo-container">
                    <img src="{{ asset('images/rbl.png') }}" alt="RBL Logo" class="img-fluid">
                    <h4>RBL</h4>
                </div>
                <nav class="mt-4">
                    <a href="{{ route('user.dashboard') }}" class="nav-link {{ Request::routeIs('user.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('user.projects') }}" class="nav-link {{ Request::routeIs('user.projects') ? 'active' : '' }}">
                        <i class="fas fa-project-diagram me-2"></i> Projects
                    </a>
                    <a href="{{ route('user.tasks') }}" class="nav-link {{ Request::routeIs('user.tasks') ? 'active' : '' }}">
                        <i class="fas fa-tasks me-2"></i> Tasks
                        @if(isset($pendingTasks) && $pendingTasks > 0)
                            <span class="notification-badge">{{ $pendingTasks }}</span>
                        @endif
                    </a>
                    <a href="{{ route('user.updates.index') }}" class="nav-link {{ Request::routeIs('user.updates.index') ? 'active' : '' }}">
                        <i class="fas fa-bell me-2"></i> Updates
                        @if(isset($unreadUpdates) && $unreadUpdates > 0)
                            <span class="notification-badge">{{ $unreadUpdates }}</span>
                        @endif
                    </a>
                    <a href="{{ route('user.discussion.index') }}" class="nav-link {{ Request::routeIs('user.discussion.index') ? 'active' : '' }}">
                        <i class="fas fa-comments me-2"></i> Messages
                        @if(isset($unreadMessages) && $unreadMessages > 0)
                            <span class="notification-badge">{{ $unreadMessages }}</span>
                        @endif
                    </a>
                    <a href="{{ route('user.profile') }}" class="nav-link {{ Request::routeIs('user.profile') ? 'active' : '' }}">
                        <i class="fas fa-user me-2"></i> Profile
                    </a>
                </nav>

                <style>
                    :root {
                        --primary-color: #1e1e2d;
                        --secondary-color: #2b2b40;
                        --accent-color: #009ef7;
                        --hover-color: #0095e8;
                        --text-light: #ffffff;
                        --shadow-color: rgba(0, 0, 0, 0.2);
                    }
                    
                    .sidebar {
                        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
                        box-shadow: 0 0 20px var(--shadow-color);
                    }
                    
                    .logo-container {
                        padding: 30px 20px;
                        text-align: center;
                        background: rgba(255, 255, 255, 0.03);
                        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
                        margin-bottom: 15px;
                    }
                    
                    .logo-container img {
                        width: 85px;
                        height: 85px;
                        object-fit: contain;
                        margin-bottom: 12px;
                        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2)) brightness(1.1);
                        transition: all 0.4s ease;
                        padding: 8px;
                        background: rgba(255, 255, 255, 0.05);
                        border-radius: 15px;
                    }
                    
                    .logo-container img:hover {
                        transform: translateY(-3px) scale(1.02);
                        filter: drop-shadow(0 6px 8px rgba(0,0,0,0.3)) brightness(1.2);
                    }
                    
                    .logo-container h4 {
                        font-size: 1.3rem;
                        font-weight: 600;
                        margin: 0;
                        color: var(--accent-color);
                        text-transform: uppercase;
                        letter-spacing: 1.5px;
                        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
                        position: relative;
                        display: inline-block;
                    }
                    
                    .logo-container h4::after {
                        content: '';
                        position: absolute;
                        bottom: -5px;
                        left: 0;
                        width: 100%;
                        height: 2px;
                        background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
                    }

                    .nav-link {
                        background: rgba(255, 255, 255, 0.03);
                        border-left: 3px solid transparent;
                    }
                    
                    .nav-link:hover, .nav-link.active {
                        background: rgba(0, 158, 247, 0.1);
                        border-left: 3px solid var(--accent-color);
                        transform: translateX(5px);
                    }
               
                
                .nav-link {
                    color: var(--text-light) !important;
                    padding: 14px 20px;
                    margin: 8px 15px;
                    border-radius: 12px;
                    transition: all 0.3s;
                    font-size: 1rem;
                    font-weight: 500;
                    display: flex;
                    align-items: center;
                    background: rgba(255, 255, 255, 0.05);
                }
                
                .nav-link:hover, .nav-link.active {
                    background: var(--accent-color);
                    transform: translateX(8px);
                    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
                }
                
                .nav-link i {
                    font-size: 1.2rem;
                    margin-right: 12px;
                    transition: transform 0.3s;
                }
                
                .nav-link:hover i {
                    transform: scale(1.1);
                }
            
            .notification-badge {
                position: absolute;
                top: -5px;
                right: 5px;
                background: #ff5252;
                color: white;
                border-radius: 50%;
                padding: 4px 8px;
                font-size: 0.75rem;
                box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            }
            
            .stats-card {
                background: white;
                border-radius: 20px;
                padding: 25px;
                margin-bottom: 20px;
                box-shadow: 0 8px 20px rgba(0,0,0,0.05);
                transition: all 0.3s;
                border: none;
                position: relative;
                overflow: hidden;
            }
            
            .stats-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 25px rgba(0,0,0,0.1);
            }
            
            .stats-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 4px;
                background: linear-gradient(90deg, var(--accent-color), var(--hover-color));
            }
            
            .logout-btn {
                background: linear-gradient(145deg, #e74c3c, #c0392b);
                color: white;
                border: none;
                padding: 14px;
                border-radius: 12px;
                font-weight: 500;
                letter-spacing: 0.5px;
                box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
            }
            
            .logout-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(231, 76, 60, 0.4);
                background: linear-gradient(145deg, #c0392b, #e74c3c);
            }
        </style>
        
        <!-- Replace the existing logout form in the sidebar with: -->
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <!-- Modify the main-content div structure -->
    <div class="main-content">
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
</body>
</html>

<style>
    .logout-form {
        position: absolute;
        bottom: 30px;
        left: 0;
        width: 100%;
        padding: 0 20px;
    }

    .logout-btn {
        width: 100%;
        background: rgba(231, 76, 60, 0.1);
        color: #fff;
        border: 1px solid rgba(231, 76, 60, 0.3);
        padding: 12px;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .logout-btn:hover {
        background: #e74c3c;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .logout-btn i {
        font-size: 1.1rem;
    }

<!-- Add these responsive styles -->
@media (max-width: 991px) {
    .sidebar {
        width: 200px;
    }
    
    .main-content {
        margin-left: 200px;
        width: calc(100% - 200px);
    }
    
    .logo-container img {
        width: 80px;
        height: 80px;
    }
}

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .sidebar.active {
        transform: translateX(0);
    }
    
    .main-content {
        margin-left: 0;
        width: 100%;
    }
    
    .mobile-toggle {
        display: block;
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1001;
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    }
    
    .stats-card {
        margin-bottom: 15px;
    }
}

@media (min-width: 769px) {
    .mobile-toggle {
        display: none;
    }
}
</style>

<!-- Add this button right after the body tag -->
<button class="mobile-toggle" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<!-- Add this script before the closing body tag -->
<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('active');
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.querySelector('.sidebar');
        const toggle = document.querySelector('.mobile-toggle');
        if (window.innerWidth <= 768 && 
            !sidebar.contains(event.target) && 
            !toggle.contains(event.target) &&
            sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        const sidebar = document.querySelector('.sidebar');
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
        }
    });
</script>
</body>
</html>