@extends('layouts.app')

@section('title', 'Terms & Conditions - LaravelShop')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">Syarat & <span class="text-primary">Ketentuan</span></h1>
        <p class="text-muted">Terakhir diperbarui: {{ date('d F Y') }}</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <h3>1. Pendahuluan</h3>
        <p>Dengan mengakses dan menggunakan website LaravelShop, Anda menyetujui syarat dan ketentuan yang berlaku.</p>
        
        <h3 class="mt-4">2. Akun Pengguna</h3>
        <p>Anda bertanggung jawab penuh atas keamanan akun Anda dan semua aktivitas yang terjadi di dalamnya.</p>
        
        <h3 class="mt-4">3. Pemesanan Produk</h3>
        <p>Semua pesanan yang Anda buat harus sesuai dengan stok yang tersedia. Kami berhak membatalkan pesanan jika terjadi kesalahan harga atau stok.</p>
        
        <h3 class="mt-4">4. Pembayaran</h3>
        <p>Pembayaran harus dilakukan sesuai dengan metode yang tersedia. Kami tidak bertanggung jawab atas kesalahan transfer.</p>
        
        <h3 class="mt-4">5. Pengiriman</h3>
        <p>Waktu pengiriman tergantung pada lokasi Anda. Kami akan menginformasikan nomor resi setelah pesanan dikirim.</p>
        
        <h3 class="mt-4">6. Pengembalian Barang</h3>
        <p>Pengembalian barang dapat dilakukan dalam waktu 14 hari setelah barang diterima, dengan syarat barang masih dalam kondisi baik.</p>
        
        <h3 class="mt-4">7. Perubahan Syarat & Ketentuan</h3>
        <p>Kami berhak mengubah syarat dan ketentuan ini sewaktu-waktu tanpa pemberitahuan sebelumnya.</p>
    </div>
</div>
@endsection