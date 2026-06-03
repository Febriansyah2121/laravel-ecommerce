@extends('layouts.guest')

@section('title', 'Login - LaravelShop')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="max-w-md w-full space-y-8 bg-white rounded-2xl shadow-2xl p-8">
        <!-- Logo & Title -->
        <div class="text-center">
            <div class="flex justify-center">
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full p-3">
                    <i class="fas fa-store text-white text-3xl"></i>
                </div>
            </div>
            <h2 class="mt-4 text-center text-3xl font-extrabold text-gray-900">
                LaravelShop
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Selamat datang kembali! Silakan login ke akun Anda
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Alamat Email
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('email') border-red-500 @enderror"
                        placeholder="admin@example.com">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('password') border-red-500 @enderror"
                        placeholder="********">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:text-purple-500">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
            </div>

            <!-- Register Link -->
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-purple-600 hover:text-purple-500">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Alert untuk user yang belum punya akun (error login)
    @if($errors->has('email') || $errors->has('password'))
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal!',
            text: 'Email atau password yang Anda masukkan salah. Belum punya akun? Silakan daftar terlebih dahulu.',
            confirmButtonColor: '#667eea',
            confirmButtonText: 'Daftar Sekarang',
            showCancelButton: true,
            cancelButtonText: 'Coba Lagi',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('register') }}";
            }
        });
    @endif
</script>
@endpush
@endsection