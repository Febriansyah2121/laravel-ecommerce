<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'slug' => 'elektronik', 'description' => 'Produk elektronik terbaru dan canggih', 'icon' => 'fa-mobile-alt'],
            ['name' => 'Fashion', 'slug' => 'fashion', 'description' => 'Pakaian dan aksesoris fashion terkini', 'icon' => 'fa-tshirt'],
            ['name' => 'Olahraga', 'slug' => 'olahraga', 'description' => 'Perlengkapan olahraga berkualitas', 'icon' => 'fa-futbol'],
            ['name' => 'Rumah Tangga', 'slug' => 'rumah', 'description' => 'Peralatan rumah tangga modern', 'icon' => 'fa-home'],
            ['name' => 'Buku', 'slug' => 'buku', 'description' => 'Buku terbaik untuk pengetahuan', 'icon' => 'fa-book'],
            ['name' => 'Travel', 'slug' => 'travel', 'description' => 'Perlengkapan traveling praktis', 'icon' => 'fa-plane'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris', 'description' => 'Aksesoris keren dan stylish', 'icon' => 'fa-headphones'],
            ['name' => 'Kecantikan', 'slug' => 'kecantikan', 'description' => 'Produk kecantikan terbaik', 'icon' => 'fa-spa'],
            ['name' => 'Makanan', 'slug' => 'makanan', 'description' => 'Makanan dan minuman lezat', 'icon' => 'fa-utensils'],
            ['name' => 'Otomotif', 'slug' => 'otomotif', 'description' => 'Perlengkapan kendaraan', 'icon' => 'fa-car'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}