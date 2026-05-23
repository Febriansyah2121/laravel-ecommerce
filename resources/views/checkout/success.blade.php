@extends('layouts.app')

@section('title', 'Pesanan Berhasil')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm text-center">
                <div class="card-body py-5">
                    <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                    <h2 class="mt-3">Pesanan Berhasil!</h2>
                    <p class="text-muted">Terima kasih telah berbelanja di LaravelShop</p>

                    <div class="alert alert-info mt-4">
                        <strong><i class="fas fa-receipt"></i> Nomor Pesanan:</strong> {{ $order->order_number }}
                    </div>

                    <div class="row mt-4 text-start">
                        <div class="col-md-6">
                            <h5><i class="fas fa-user"></i> Detail Pesanan</h5>
                            <hr>
                            <p>
                                <strong>Nama:</strong> {{ $order->customer_name }}<br>
                                <strong>Email:</strong> {{ $order->customer_email }}<br>
                                <strong>Telepon:</strong> {{ $order->customer_phone }}<br>
                                <strong>Alamat:</strong> {{ $order->shipping_address }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-credit-card"></i> Detail Pembayaran</h5>
                            <hr>
                            <p>
                                <strong>Total:</strong> <span class="h5 text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span><br>
                                <strong>Metode:</strong> 
                                @if($order->payment_method == 'cod') Cash on Delivery
                                @elseif($order->payment_method == 'transfer') Bank Transfer
                                @else Kartu Kredit
                                @endif<br>
                                <strong>Status:</strong> <span class="badge bg-warning">{{ $order->status_label }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fas fa-home"></i> Kembali ke Beranda
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary ms-2">
                            <i class="fas fa-shopping-bag"></i> Belanja Lagi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection