<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil kategori berdasarkan slug
        $categories = Category::all()->keyBy('slug');

        $products = [
            // Elektronik
            ['name' => 'Smartphone Galaxy A54', 'description' => 'Smartphone dengan layar 6.4 inch Super AMOLED, kamera 50MP, baterai 5000mAh', 'price' => 5499000, 'stock' => 25, 'category_slug' => 'elektronik'],
            ['name' => 'Laptop Gaming ROG', 'description' => 'Laptop gaming Intel Core i7, RAM 16GB, SSD 512GB, VGA RTX 3060', 'price' => 15999000, 'stock' => 10, 'category_slug' => 'elektronik'],
            ['name' => 'Wireless Headphone', 'description' => 'Headphone bluetooth noise cancellation, baterai tahan 30 jam', 'price' => 599000, 'stock' => 50, 'category_slug' => 'elektronik'],
            ['name' => 'Smartwatch Series 8', 'description' => 'Smartwatch dengan fitur kesehatan, GPS, tahan air', 'price' => 2499000, 'stock' => 30, 'category_slug' => 'elektronik'],
            ['name' => 'Power Bank 20000mAh', 'description' => 'Power bank fast charging, dual USB output', 'price' => 299000, 'stock' => 55, 'category_slug' => 'elektronik'],
            
            // Fashion
            ['name' => 'Kemeja Pria Casual', 'description' => 'Kemeja katun premium, nyaman dipakai, tersedia S-XXL', 'price' => 199000, 'stock' => 100, 'category_slug' => 'fashion'],
            ['name' => 'Jaket Denim Pria', 'description' => 'Jaket denim berkualitas, model trendy, cocok untuk gaya kasual', 'price' => 399000, 'stock' => 45, 'category_slug' => 'fashion'],
            ['name' => 'Tas Ransel Pria', 'description' => 'Tas ransel casual dengan banyak kompartemen', 'price' => 279000, 'stock' => 40, 'category_slug' => 'fashion'],
            ['name' => 'Sepatu Formal Pria', 'description' => 'Sepatu formal kulit asli, nyaman dipakai', 'price' => 499000, 'stock' => 35, 'category_slug' => 'fashion'],
            ['name' => 'Jam Tangan Pria', 'description' => 'Jam tangan analog dengan desain elegan', 'price' => 350000, 'stock' => 60, 'category_slug' => 'fashion'],
            
            // Olahraga
            ['name' => 'Sepatu Running', 'description' => 'Sepatu lari sol empuk, ringan, nyaman untuk olahraga', 'price' => 449000, 'stock' => 60, 'category_slug' => 'olahraga'],
            ['name' => 'Yoga Mat Premium', 'description' => 'Matras yoga tebal 10mm, anti slip, nyaman untuk latihan yoga', 'price' => 189000, 'stock' => 75, 'category_slug' => 'olahraga'],
            ['name' => 'Dumbbell 5kg', 'description' => 'Dumbbell set 5kg untuk latihan di rumah', 'price' => 250000, 'stock' => 40, 'category_slug' => 'olahraga'],
            ['name' => 'Bola Sepak', 'description' => 'Bola sepak berkualitas standar FIFA', 'price' => 180000, 'stock' => 30, 'category_slug' => 'olahraga'],
            ['name' => 'Raket Badminton', 'description' => 'Raket badminton ringan dan kuat', 'price' => 150000, 'stock' => 50, 'category_slug' => 'olahraga'],
            
            // Rumah Tangga
            ['name' => 'Meja Belajar Minimalis', 'description' => 'Meja belajar kayu jati, desain minimalis, kokoh dan awet', 'price' => 899000, 'stock' => 15, 'category_slug' => 'rumah'],
            ['name' => 'Lampu Meja LED', 'description' => 'Lampu belajar LED dengan 3 mode cahaya, adjustable brightness', 'price' => 149000, 'stock' => 80, 'category_slug' => 'rumah'],
            ['name' => 'Sofa Minimalis', 'description' => 'Sofa nyaman dengan desain modern', 'price' => 2500000, 'stock' => 10, 'category_slug' => 'rumah'],
            ['name' => 'Karpet Bulu', 'description' => 'Karpet lembut untuk ruang tamu', 'price' => 350000, 'stock' => 25, 'category_slug' => 'rumah'],
            ['name' => 'Set Peralatan Makan', 'description' => 'Set piring dan gelas keramik 12 pcs', 'price' => 200000, 'stock' => 40, 'category_slug' => 'rumah'],
            
            // Buku
            ['name' => 'Atomic Habits', 'description' => 'Buku best seller tentang kebiasaan kecil', 'price' => 110000, 'stock' => 60, 'category_slug' => 'buku'],
            ['name' => 'Rich Dad Poor Dad', 'description' => 'Buku investasi terlaris sepanjang masa', 'price' => 125000, 'stock' => 25, 'category_slug' => 'buku'],
            ['name' => 'The Psychology of Money', 'description' => 'Psikologi dalam keuangan', 'price' => 130000, 'stock' => 40, 'category_slug' => 'buku'],
            
            // Travel
            ['name' => 'Koper Kabin 20 inch', 'description' => 'Koper travel ukuran cabin 20 inch', 'price' => 450000, 'stock' => 30, 'category_slug' => 'travel'],
            ['name' => 'Tas Ransel Travel', 'description' => 'Tas ransel anti air untuk travel', 'price' => 280000, 'stock' => 50, 'category_slug' => 'travel'],
            ['name' => 'Neck Pillow', 'description' => 'Bantal leher untuk perjalanan jauh', 'price' => 89000, 'stock' => 100, 'category_slug' => 'travel'],
            
            // Aksesoris
            ['name' => 'Case HP Silikon', 'description' => 'Case HP anti gores', 'price' => 50000, 'stock' => 200, 'category_slug' => 'aksesoris'],
            ['name' => 'Screen Protector', 'description' => 'Pelindung layar anti pecah', 'price' => 35000, 'stock' => 150, 'category_slug' => 'aksesoris'],
        ];

        foreach ($products as $product) {
            $category = $categories[$product['category_slug']] ?? null;
            if ($category) {
                Product::create([
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}