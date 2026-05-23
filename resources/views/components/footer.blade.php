<!-- Footer Component -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5><i class="fas fa-store"></i> LaravelShop</h5>
                <p class="text-muted small">Platform e-commerce terpercaya yang menyediakan berbagai produk berkualitas dengan harga terbaik.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-md-2 mb-4">
                <h5>Menu</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Categories</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('products.index', ['category' => 'elektronik']) }}">Elektronik</a></li>
                    <li><a href="{{ route('products.index', ['category' => 'fashion']) }}">Fashion</a></li>
                    <li><a href="{{ route('products.index', ['category' => 'olahraga']) }}">Olahraga</a></li>
                    <li><a href="{{ route('products.index', ['category' => 'rumah']) }}">Rumah Tangga</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Contact Info</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia</li>
                    <li><i class="fas fa-phone"></i> +62 812 3456 7890</li>
                    <li><i class="fas fa-envelope"></i> info@laravelshop.com</li>
                </ul>
            </div>
        </div>
        <div class="copyright text-center pt-4 mt-3">
            <p>&copy; {{ date('Y') }} LaravelShop. All rights reserved. | Built with <i class="fas fa-heart text-danger"></i> using Laravel</p>
        </div>
    </div>
</footer>

<style>
.footer {
    background: #1a1a2e;
    color: #ccc;
    padding: 50px 0 20px;
    margin-top: 60px;
}
.footer h5 {
    color: white;
    margin-bottom: 20px;
    font-size: 1.1rem;
}
.footer ul {
    list-style: none;
    padding-left: 0;
}
.footer ul li {
    margin-bottom: 8px;
}
.footer ul li a {
    color: #aaa;
    text-decoration: none;
    transition: 0.2s;
}
.footer ul li a:hover {
    color: #ff6b35;
    padding-left: 5px;
}
.footer ul li i {
    width: 25px;
    color: #ff6b35;
}
.social-links {
    display: flex;
    gap: 12px;
    margin-top: 15px;
}
.social-links a {
    width: 35px;
    height: 35px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: 0.2s;
}
.social-links a:hover {
    background: #ff6b35;
    transform: translateY(-3px);
}
.copyright {
    border-top: 1px solid #333;
}
</style>resources/views/layouts/app.blade.php
