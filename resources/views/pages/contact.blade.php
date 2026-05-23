@extends('layouts.app')

@section('title', 'Contact Us - LaravelShop')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">Hubungi <span class="text-primary">Kami</span></h1>
        <p class="text-muted">Kami siap membantu Anda 24/7</p>
    </div>

    <div class="row g-5">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h3 class="mb-4"><i class="fas fa-address-card text-primary me-2"></i> Informasi Kontak</h3>
                
                <div class="contact-item mb-4">
                    <i class="fas fa-map-marker-alt text-primary fs-4"></i>
                    <div>
                        <strong>Alamat</strong>
                        <p class="mb-0 text-muted">{{ $contactInfo['address'] }}</p>
                    </div>
                </div>
                
                <div class="contact-item mb-4">
                    <i class="fas fa-phone text-primary fs-4"></i>
                    <div>
                        <strong>Telepon</strong>
                        <p class="mb-0 text-muted">{{ $contactInfo['phone'] }}</p>
                    </div>
                </div>
                
                <div class="contact-item mb-4">
                    <i class="fas fa-envelope text-primary fs-4"></i>
                    <div>
                        <strong>Email</strong>
                        <p class="mb-0 text-muted">{{ $contactInfo['email'] }}</p>
                    </div>
                </div>
                
                <div class="contact-item mb-4">
                    <i class="fab fa-whatsapp text-primary fs-4"></i>
                    <div>
                        <strong>WhatsApp</strong>
                        <p class="mb-0 text-muted">{{ $contactInfo['whatsapp'] }}</p>
                    </div>
                </div>

                <div class="contact-item mb-4">
                    <i class="far fa-clock text-primary fs-4"></i>
                    <div>
                        <strong>Jam Operasional</strong>
                        @foreach($contactInfo['business_hours'] as $day => $hour)
                            <p class="mb-0 text-muted">{{ $day }}: {{ $hour }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h3 class="mb-4"><i class="fas fa-paper-plane text-primary me-2"></i> Kirim Pesan</h3>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Nama Lengkap">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Subjek">
                        </div>
                        <div class="col-12">
                            <textarea rows="5" class="form-control" placeholder="Pesan Anda..."></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                                Kirim Pesan <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322339!2d106.828561!3d-6.208763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3c9452b3a5f%3A0x8d3f9b2c1e5a6d7e!2sJakarta!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</div>

<style>
.contact-item {
    display: flex;
    gap: 15px;
    align-items: flex-start;
}
.form-control {
    padding: 12px;
    border-radius: 12px;
    border: 1px solid #ddd;
}
.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
}
</style>
@endsection