@extends('layouts.app')

@section('title', 'About Us - LaravelShop')

@section('content')
<div class="container py-5">
    <div class="about-header text-center mb-5">
        <h1 class="display-5 fw-bold">Tentang <span class="text-primary">LaravelShop</span></h1>
        <p class="text-muted">Platform e-commerce terpercaya sejak 2024</p>
    </div>

    <div class="row g-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h3 class="mb-3"><i class="fas fa-bullseye text-primary me-2"></i> Visi Kami</h3>
                <p>{{ $companyInfo['vision'] }}</p>
                
                <h3 class="mb-3 mt-4"><i class="fas fa-rocket text-primary me-2"></i> Misi Kami</h3>
                <ul>
                    @foreach($companyInfo['mission'] as $mission)
                        <li>{{ $mission }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h3 class="mb-3"><i class="fas fa-users text-primary me-2"></i> Tim Kami</h3>
                <div class="row">
                    @foreach($companyInfo['team'] as $member)
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="team-avatar">
                                    <i class="fas fa-user-circle fa-3x text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $member['name'] }}</h6>
                                    <small class="text-muted">{{ $member['position'] }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 text-center">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <h2 class="text-primary fw-bold">500+</h2>
                    <p>Produk Terjual</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <h2 class="text-primary fw-bold">1000+</h2>
                    <p>Pelanggan Puas</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <h2 class="text-primary fw-bold">24/7</h2>
                    <p>Layanan Customer</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stat-card {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 20px;
    text-align: center;
}
.team-avatar i {
    font-size: 48px;
}
</style>
@endsection