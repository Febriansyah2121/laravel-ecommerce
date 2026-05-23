@extends('layouts.app')

@section('title', 'Privacy Policy - LaravelShop')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">Kebijakan <span class="text-primary">Privasi</span></h1>
        <p class="text-muted">Terakhir diperbarui: {{ date('d F Y') }}</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <h3>Informasi yang Kami Kumpulkan</h3>
        <p>Kami mengumpulkan informasi yang Anda berikan saat mendaftar, melakukan pemesanan, atau menghubungi layanan pelanggan kami.</p>
        
        <h3 class="mt-4">Penggunaan Informasi</h3>
        <p>Informasi Anda digunakan untuk memproses pesanan, memberikan layanan pelanggan, dan mengirimkan update tentang produk kami.</p>
        
        <h3 class="mt-4">Keamanan Data</h3>
        <p>Kami melindungi informasi pribadi Anda dengan sistem keamanan berstandar tinggi dan tidak akan membagikan data Anda kepada pihak ketiga tanpa izin.</p>
        
        <h3 class="mt-4">Cookie</h3>
        <p>Website kami menggunakan cookie untuk meningkatkan pengalaman berbelanja Anda.</p>
        
        <h3 class="mt-4">Hubungi Kami</h3>
        <p>Jika Anda memiliki pertanyaan tentang kebijakan privasi, silakan hubungi kami di <a href="mailto:privacy@laravelshop.com">privacy@laravelshop.com</a></p>
    </div>
</div>
@endsection