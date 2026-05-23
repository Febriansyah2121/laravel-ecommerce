<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel E-Commerce')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fc;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white !important;
        }
        .navbar-brand i {
            margin-right: 8px;
        }
        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: 0.3s;
        }
        .nav-link:hover {
            opacity: 0.8;
        }
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -12px;
            background: #ff6b35;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .footer {
            background: #1a1a2e;
            color: white;
            padding: 40px 0;
            margin-top: 50px;
            text-align: center;
        }
        .footer p {
            margin: 0;
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background: #ff6b35;
            border: none;
        }
        .btn-primary:hover {
            background: #e55a2b;
        }
        .btn-outline-primary {
            border-color: #ff6b35;
            color: #ff6b35;
        }
        .btn-outline-primary:hover {
            background: #ff6b35;
            color: white;
        }
        .pagination .page-link {
            color: #ff6b35;
        }
        .pagination .active .page-link {
            background: #ff6b35;
            border-color: #ff6b35;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-store"></i> LaravelShop
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon bg-white rounded"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('products.index') }}">Products</a>  <!-- ← INI SUDAH BENAR -->
    </li>
    <li class="nav-item position-relative">
        <a class="nav-link" href="{{ route('cart.index') }}">
            <i class="fas fa-shopping-cart"></i> Cart
            @php
                $cartCount = session()->get('cart') ? count(session()->get('cart')) : 0;
            @endphp
            @if($cartCount > 0)
                <span class="cart-badge">{{ $cartCount }}</span>
            @endif
        </a>
    </li>
</ul>
        </div>
    </div>
</nav>

<main style="min-height: calc(100vh - 200px);">
    @yield('content')
</main>

<footer class="footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} LaravelShop - E-Commerce Platform</p>
        <p class="mt-2">Built with <i class="fas fa-heart text-danger"></i> using Laravel</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>