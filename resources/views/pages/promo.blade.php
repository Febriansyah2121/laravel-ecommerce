@extends('layouts.app')

@section('title', 'Promo - LaravelShop')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">Promo & <span class="text-primary">Diskon</span></h1>
        <p class="text-muted">Dapatkan penawaran menarik hanya di LaravelShop</p>
    </div>

    <div class="row g-4">
        @foreach($promos as $promo)
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 promo-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="promo-icon">
                                <i class="fas fa-tag fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h4 class="mb-2">{{ $promo['title'] }}</h4>
                                <p class="text-muted mb-2"><i class="far fa-calendar-alt me-1"></i> Berlaku hingga: {{ date('d F Y', strtotime($promo['expired'])) }}</p>
                                <a href="#" class="text-primary text-decoration-none">Klaim Sekarang →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-5">
        <div class="alert alert-info rounded-4">
            <i class="fas fa-info-circle me-2"></i> 
            Promo tidak dapat digabungkan dengan promo lainnya. Syarat dan ketentuan berlaku.
        </div>
    </div>
</div>

<style>
.promo-card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.promo-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
}
.promo-icon {
    background: linear-gradient(135deg, #667eea20, #764ba220);
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
}
</style>
@endsection