<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Smartphone Galaxy A54', 'description' => 'Smartphone dengan layar 6.4 inch Super AMOLED, kamera 50MP', 'price' => 5499000, 'stock' => 25, 'category' => 'elektronik'],
            ['name' => 'Laptop Gaming ROG', 'description' => 'Laptop gaming Intel Core i7, RAM 16GB, SSD 512GB', 'price' => 15999000, 'stock' => 10, 'category' => 'elektronik'],
            ['name' => 'Wireless Headphone', 'description' => 'Headphone bluetooth noise cancellation, baterai tahan 30 jam', 'price' => 599000, 'stock' => 50, 'category' => 'elektronik'],
            ['name' => 'Smartwatch Series 8', 'description' => 'Smartwatch dengan fitur kesehatan, GPS, tahan air', 'price' => 2499000, 'stock' => 30, 'category' => 'elektronik'],
            ['name' => 'Kemeja Pria Casual', 'description' => 'Kemeja katun premium, nyaman dipakai', 'price' => 199000, 'stock' => 100, 'category' => 'fashion'],
            ['name' => 'Jaket Denim Pria', 'description' => 'Jaket denim berkualitas, model trendy', 'price' => 399000, 'stock' => 45, 'category' => 'fashion'],
            ['name' => 'Sepatu Running', 'description' => 'Sepatu lari sol empuk, ringan, nyaman', 'price' => 449000, 'stock' => 60, 'category' => 'olahraga'],
            ['name' => 'Yoga Mat Premium', 'description' => 'Matras yoga tebal 10mm, anti slip', 'price' => 189000, 'stock' => 75, 'category' => 'olahraga'],
            ['name' => 'Meja Belajar Minimalis', 'description' => 'Meja belajar kayu jati, desain minimalis', 'price' => 899000, 'stock' => 15, 'category' => 'rumah'],
            ['name' => 'Lampu Meja LED', 'description' => 'Lampu belajar LED dengan 3 mode cahaya', 'price' => 149000, 'stock' => 80, 'category' => 'rumah'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}