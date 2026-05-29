<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat user test (tetap dipertahankan)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Tambahan: Buat user admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // ============================================
        // PANGGIL SEEDER UNTUK KATEGORI DAN PRODUK
        // ============================================
        $this->call([
            CategorySeeder::class,  // Seeder untuk kategori
            ProductSeeder::class,   // Seeder untuk produk
        ]);
    }
}