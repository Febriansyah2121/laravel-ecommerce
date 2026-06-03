@extends('layouts.guest')

@section('title', 'Register - LaravelShop')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="max-w-md w-full space-y-8 bg-white rounded-2xl shadow-2xl p-8">
        <!-- Logo & Title -->
        <div class="text-center">
            <div class="flex justify-center">
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full p-3">
                    <i class="fas fa-user-plus text-white text-3xl"></i>
                </div>
            </div>
            <h2 class="mt-4 text-center text-3xl font-extrabold text-gray-900">
                Daftar Akun
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Buat akun baru untuk berbelanja di LaravelShop
            </p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Lengkap
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('name') border-red-500 @enderror"
                        placeholder="Nama lengkap">
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Alamat Email
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                        class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('email') border-red-500 @enderror"
                        placeholder="email@example.com">
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
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('password') border-red-500 @enderror"
                        placeholder="********">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                    Konfirmasi Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-check-circle text-gray-400"></i>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        placeholder="********">
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200">
                    <i class="fas fa-user-plus mr-2"></i> Daftar
                </button>
            </div>

            <!-- Login Link -->
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:text-purple-500">
                        Login Sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection