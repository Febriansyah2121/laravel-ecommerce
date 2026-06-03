<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Shopcart - Modern E-commerce')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
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
    
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Poppins', sans-serif; }
        section { scroll-margin-top: 80px; }
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #FF7A00;
            color: white;
            font-size: 10px;
            font-weight: bold;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-press { transition: all 0.2s ease; }
        .btn-press:hover { transform: translateY(-2px); }
        .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-6px); box-shadow: 0 20px 40px -15px rgba(15,23,42,.2); }
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
        }
        .group:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-white">

<!-- Header -->
<header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-slate-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                <span class="w-8 h-8 rounded-lg bg-brand-orange flex items-center justify-center text-white font-bold">S</span>
                <span class="text-xl font-bold">Shopcart</span>
            </a>
            
            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-sm font-medium text-slate-600 hover:text-brand-orange transition">Home</a>
                <a href="{{ route('products.index') }}" class="text-sm font-medium text-slate-600 hover:text-brand-orange transition">Products</a>
                <a href="{{ route('cart.index') }}" class="text-sm font-medium text-slate-600 hover:text-brand-orange transition">Cart</a>
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-slate-600 hover:text-brand-orange transition">Admin Panel</a>
                    @endif
                @endauth
            </nav>
            
            <div class="hidden md:flex flex-1 max-w-md mx-4">
                <div class="relative w-full">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="text" id="globalSearch" placeholder="Search Product..." class="w-full pl-10 pr-4 py-2 rounded-full bg-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-brand-orange/50">
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('cart.index') }}" class="relative w-10 h-10 flex items-center justify-center rounded-full bg-slate-100 hover:bg-slate-200 transition">
                    <i class="fas fa-shopping-cart text-slate-600"></i>
                    @php 
                        $cart = session()->get('cart', []);
                        $cartCount = 0;
                        foreach ($cart as $item) { $cartCount += $item['quantity']; }
                    @endphp
                    @if($cartCount > 0)
                        <span class="cart-badge" id="cartCount">{{ $cartCount }}</span>
                    @endif
                </a>
                
                @auth
                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 px-4 py-2 rounded-full bg-brand-dark text-white text-sm font-medium hover:bg-black transition">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50 border border-slate-100">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 transition">
                                <i class="fas fa-user-circle"></i> Profile
                            </a>
                            <hr class="my-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-sm text-red-600 hover:bg-slate-50 transition">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 rounded-full bg-brand-dark text-white text-sm font-medium hover:bg-black transition">
                        <i class="fas fa-user"></i> Sign in
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer class="bg-slate-900 text-white pt-12 pb-8 mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-8 h-8 rounded-lg bg-brand-orange flex items-center justify-center font-bold">S</span>
                    <span class="text-xl font-bold">Shopcart</span>
                </div>
                <p class="text-slate-400 text-sm">Your favorite online shopping destination with the best deals and fast delivery.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li><a href="{{ route('home') }}" class="hover:text-brand-orange transition">Home</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-brand-orange transition">Products</a></li>
                    <li><a href="{{ route('cart.index') }}" class="hover:text-brand-orange transition">Cart</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Support</h4>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li><a href="#" class="hover:text-brand-orange transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-brand-orange transition">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-brand-orange transition">Terms & Conditions</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Newsletter</h4>
                <p class="text-sm text-slate-400 mb-3">Get latest deals to your inbox.</p>
                <div class="flex">
                    <input type="email" placeholder="Your email" class="flex-1 px-4 py-2 rounded-l-lg text-gray-800 focus:outline-none">
                    <button class="px-4 py-2 bg-brand-orange rounded-r-lg hover:bg-brand-orangeDark transition">Subscribe</button>
                </div>
            </div>
        </div>
        <div class="border-t border-slate-800 mt-8 pt-6 text-center text-sm text-slate-400">
            &copy; {{ date('Y') }} Shopcart. All rights reserved.
        </div>
    </div>
</footer>

<script>
// Global search
const globalSearch = document.getElementById('globalSearch');
if (globalSearch) {
    globalSearch.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('.product-card-item').forEach(card => {
            const productName = card.querySelector('.product-name')?.innerText.toLowerCase() || '';
            card.style.display = productName.includes(searchTerm) ? '' : 'none';
        });
    });
}

// Update cart badge function
function updateCartBadge(count) {
    const badge = document.getElementById('cartCount');
    if (badge) {
        if (count > 0) {
            badge.innerText = count;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }
    }
}
</script>

@stack('scripts')
</body>
</html>