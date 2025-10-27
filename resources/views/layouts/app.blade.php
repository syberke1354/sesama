<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Bansos', 'Sistem Bansos Pendidikan') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #1e3a8a;
            --dark-blue: #1e40af;
            --light-blue: #3b82f6;
            --accent-blue: #2563eb;
            --text-gray: #374151;
            --light-gray: #f8fafc;
            --primary-green: #00a693;
            --primary-dark: #1a1a1a;
            --text-dark: #333333;
            --text-muted: #6c757d;
            --bg-light: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8fafc;
        }

        /* === Sidebar Styles === */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 270px;
            height: 100vh;
            background: var(--primary-blue);
            border-radius: 0 20px 20px 0;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 1020;
            padding: 20px 10px;
        }

        /* Sidebar link style */
        .sidebar .nav-link {
            color: white;
            padding: 10px 16px;
            margin: 6px 12px;
            border-radius: 10px;
            transition: all 0.18s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: var(--primary-blue);
            background-color: white;
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* === Main Content Area === */
        .main-content {
            margin-left: 285px;
            padding: 25px;
            min-height: 100vh;
            background: white;
            border-radius: 20px 0 0 20px;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
        }

        /* === Responsive (Mobile) === */
        @media (max-width: 767.98px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
                border-radius: 0;
                box-shadow: none;
            }
        }

        /* Alerts */
        .alert-success {
            border-left: 5px solid #10b981;
        }

        .alert-danger {
            border-left: 5px solid #ef4444;
        }

        /* Button */
        .btn-primary {
            background: var(--accent-blue);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Table header color */
        .table th {
            background: var(--primary-blue);
            color: white;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Sidebar (desktop) -->
    <nav class="sidebar">
        @include('partials.sidebar')
    </nav>

    <!-- Mobile Navbar -->
    <div class="d-md-none p-2 bg-primary text-white d-flex justify-content-between align-items-center">
        <button class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <span>{{ config('Bansos', 'Berbagi Asa') }}</span>
    </div>

    <!-- Sidebar mobile -->
    <div class="offcanvas offcanvas-start text-white sidebar-mobile" tabindex="-1" id="mobileSidebar">
        <div class="offcanvas-header">
            <h5>Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            @include('partials.sidebar')
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="pt-4 pb-3">
            <h1 class="h2 mb-4" style="color: var(--text-gray); font-weight: 700;">@yield('title', 'Dashboard')</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
