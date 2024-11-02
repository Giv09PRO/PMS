<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Management System</title>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
            --text-color: #ecf0f1;
        }
        
        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
            color: var(--text-color);
            padding-top: 20px;
            transform: translateZ(0);
            will-change: transform;
            transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                will-change: transform;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .content {
                margin-left: 0 !important;
            }
        }

        .sidebar h2 {
            padding: 15px;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(5px);
        }

        .sidebar a {
            color: var(--text-color);
            text-decoration: none;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 8px;
            margin: 0 10px;
        }

        .sidebar a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar a:hover {
            background-color: var(--accent-color);
            transform: translateX(5px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            min-height: calc(100vh - 60px);
            transition: margin-left 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: margin-left;
        }

        .navbar {
            background: var(--primary-color) !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
        }

        .nav-link {
            position: relative;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--accent-color);
            transition: width 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link:hover:after {
            width: 100%;
        }

        footer {
            background: var(--primary-color) !important;
            position: relative;
            padding: 20px 0;
            margin-left: 250px;
            transition: margin-left 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 768px) {
            footer {
                margin-left: 0;
            }
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.07);
            transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0,0,0,0.1);
        }

        .fade-in {
            animation: fadeIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: opacity;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-menu {
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.98);
        }

        .dropdown-item {
            transition: background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 4px;
            margin: 2px 4px;
        }

        .btn {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="min-height: 90px;">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown me-3">
                    <button class="btn btn-link text-white position-relative" type="button" id="notificationsDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown" style="z-index: 1000;">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-info-circle me-2"></i>New student enrolled</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-exclamation-circle me-2"></i>Exam schedule updated</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-bell me-2"></i>View all notifications</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-link text-white d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=random" class="rounded-circle me-2" width="32" height="32" loading="lazy">
                        <span>Admin</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style="z-index: 1000;">
                        <li><a class="dropdown-item disabled" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item disabled" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <button type="button" class="dropdown-item disabled"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="border-b border-gray-700">
            <h2 class="text-center text-xl font-bold text-white flex items-center justify-center">
                <i class="fas fa-university text-accent me-2"></i>SIMS
            </h2>
        </div>
        <div class="sidebar-links p-3">
            <a href="{{ route('dashboard') }}" class="mb-2 p-3 flex items-center text-gray-300 hover:bg-primary-700 rounded-lg transition-all duration-300">
                <i class="fas fa-home text-accent me-3"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('students.index') }}" class="mb-2 p-3 flex items-center text-gray-300 hover:bg-primary-700 rounded-lg transition-all duration-300">
                <i class="fas fa-user-graduate text-accent me-3"></i>
                <span>Students</span>
            </a>
            <a href="{{ route('teachers.index') }}" class="mb-2 p-3 flex items-center text-gray-300 hover:bg-primary-700 rounded-lg transition-all duration-300">
                <i class="fas fa-chalkboard-teacher text-accent me-3"></i>
                <span>Teachers</span>
            </a>
            <a href="{{ route('SchoolClasses.index') }}" class="mb-2 p-3 flex items-center text-gray-300 hover:bg-primary-700 rounded-lg transition-all duration-300">
                <i class="fas fa-school text-accent me-3"></i>
                <span>Classes</span>
            </a>
            <a href="{{ route('exams.index') }}" class="mb-2 p-3 flex items-center text-gray-300 hover:bg-primary-700 rounded-lg transition-all duration-300">
                <i class="fas fa-book text-accent me-3"></i>
                <span>Exams</span>
            </a>
            <a href="{{ route('fees.index') }}" class="mb-2 p-3 flex items-center text-gray-300 hover:bg-primary-700 rounded-lg transition-all duration-300">
                <i class="fas fa-money-bill-wave text-accent me-3"></i>
                <span>Fees</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content fade-in">
        <main class="container py-4">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="text-white text-center py-3">
        <div class="container">
            <p class="mb-0">© {{ date('Y') }} Student Management System. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile with improved performance
        const sidebar = document.querySelector('.sidebar');
        const navbarToggler = document.querySelector('.navbar-toggler');
        
        navbarToggler.addEventListener('click', () => {
            requestAnimationFrame(() => {
                sidebar.classList.toggle('active');
            });
        });

        // Close sidebar when clicking outside on mobile with debounce
        let timeout;
        document.addEventListener('click', (event) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                if (window.innerWidth <= 768 && 
                    !sidebar.contains(event.target) && 
                    !navbarToggler.contains(event.target)) {
                    requestAnimationFrame(() => {
                        sidebar.classList.remove('active');
                    });
                }
            }, 50);
        });
    </script>
</body>
</html>