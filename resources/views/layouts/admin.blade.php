<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Shopcart')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: { brand: { orange: '#FF7A00', orangeDark: '#E66A00', dark: '#0F172A' } },
                    boxShadow: { soft: '0 10px 30px -12px rgba(15,23,42,0.15)' }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #F8FAFC; }
    </style>
</head>
<body>

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-brand-dark fixed left-0 top-0 h-full overflow-y-auto">
        <div class="p-5 border-b border-white/10">
            <div class="flex items-center gap-2">
                <span class="w-9 h-9 rounded-xl bg-brand-orange grid place-items-center text-white font-bold">S</span>
                <span class="text-white font-bold text-lg">Shopcart Admin</span>
            </div>
        </div>
        <nav class="p-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : '' }}">
                <i class="fas fa-tachometer-alt w-5"></i> Dashboard
            </a>
            <!-- MENU KATEGORI - TAMBAHKAN INI -->
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition {{ request()->routeIs('admin.categories.*') ? 'bg-white/10 text-white' : '' }}">
                <i class="fas fa-folder w-5"></i> Kategori
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition {{ request()->routeIs('admin.products.*') ? 'bg-white/10 text-white' : '' }}">
                <i class="fas fa-box w-5"></i> Produk
            </a>
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition">
                <i class="fas fa-store w-5"></i> Lihat Toko
            </a>
        </nav>
        <div class="absolute bottom-0 w-full p-4 border-t border-white/10 bg-brand-dark">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition">
                    <i class="fas fa-sign-out-alt w-5"></i> Logout
                </button>
            </form>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="ml-64 flex-1 p-6">
        <div class="bg-white rounded-2xl shadow-soft p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-slate-500 text-sm mt-1">Welcome back, {{ Auth::user()->name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-slate-500">{{ now()->format('l, d F Y') }}</p>
                </div>
            </div>
        </div>
        
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>