<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - LaravelShop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
        }
        .admin-sidebar {
            background: #1a1a2e;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            padding: 20px 0;
        }
        .admin-sidebar .brand {
            text-align: center;
            padding: 20px;
            color: white;
            font-size: 1.3rem;
            font-weight: bold;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .admin-sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 24px;
            transition: 0.2s;
        }
        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
        }
        .admin-sidebar .nav-link i {
            width: 24px;
            margin-right: 10px;
        }
        .admin-content {
            margin-left: 260px;
            padding: 20px;
        }
        .navbar-top {
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: 0.3s;
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="admin-sidebar">
        <div class="brand">
            <i class="fas fa-store"></i> LaravelShop
        </div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="fas fa-box"></i> Produk
            </a>
            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                <i class="fas fa-globe"></i> Lihat Website
            </a>
        </nav>
    </div>

    <div class="admin-content">
        <div class="navbar-top d-flex justify-content-between align-items-center">
            <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
            <div>
                <span class="text-muted">Admin Panel</span>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>