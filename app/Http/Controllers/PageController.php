<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan halaman beranda (Home)
     */
    public function home()
    {
        $featuredProducts = Product::orderBy('id', 'desc')->limit(8)->get();
        $popularProducts = Product::orderBy('id', 'asc')->limit(4)->get();
        
        return view('pages.home', compact('featuredProducts', 'popularProducts'));
    }

    /**
     * Menampilkan halaman tentang (About)
     */
    public function about()
{
    $companyInfo = [
        'name' => 'LaravelShop',
        'founded' => 2024,
        'vision' => 'Menjadi platform e-commerce terpercaya di Indonesia',
        'mission' => [
            'Menyediakan produk berkualitas',
            'Pelayanan customer terbaik',
            'Pengiriman cepat dan aman'
        ],
        'team' => [
            ['name' => 'Ahmad Fauzi', 'position' => 'CEO & Founder'],
            ['name' => 'Siti Aminah', 'position' => 'Head of Operations'],
            ['name' => 'Budi Santoso', 'position' => 'Lead Developer'],
            ['name' => 'Dewi Lestari', 'position' => 'Customer Service'],
        ]
    ];
    
    return view('pages.about', compact('companyInfo'));
}

    /**
     * Menampilkan halaman FAQ (Frequently Asked Questions)
     */
    public function faq()
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara melakukan pemesanan?',
                'answer' => 'Anda dapat memilih produk, tambahkan ke keranjang, lalu checkout dan isi data pengiriman.'
            ],
            [
                'question' => 'Apakah bisa mengembalikan barang?',
                'answer' => 'Ya, kami menerima pengembalian dalam 14 hari dengan kondisi barang masih baik.'
            ],
            [
                'question' => 'Berapa lama waktu pengiriman?',
                'answer' => 'Pengiriman dalam kota 1-2 hari, luar kota 3-5 hari kerja.'
            ],
            [
                'question' => 'Apakah ada garansi produk?',
                'answer' => 'Semua produk memiliki garansi resmi 1 tahun.'
            ],
            [
                'question' => 'Metode pembayaran apa saja?',
                'answer' => 'Kami menerima COD, Transfer Bank, dan Kartu Kredit.'
            ]
        ];
        
        return view('pages.faq', compact('faqs'));
    }

    /**
     * Menampilkan halaman kebijakan privasi (Privacy Policy)
     */
    public function privacy()
    {
        return view('pages.privacy');
    }

    /**
     * Menampilkan halaman syarat & ketentuan (Terms & Conditions)
     */
    public function terms()
    {
        return view('pages.terms');
    }

    /**
     * Menampilkan halaman promo/diskon (Promo)
     */
    public function promo()
    {
        $promos = [
            ['title' => 'Diskon 20% untuk produk elektronik', 'expired' => '2024-12-31'],
            ['title' => 'Beli 2 gratis 1 untuk produk fashion', 'expired' => '2024-12-31'],
            ['title' => 'Gratis ongkir minimal belanja Rp 500.000', 'expired' => '2024-12-31'],
            ['title' => 'Diskon 10% untuk member baru', 'expired' => '2024-12-31'],
        ];
        
        return view('pages.promo', compact('promos'));
    }
}