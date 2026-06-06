<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category', 'all');
        $search = $request->input('search', '');
        
        $query = Product::query();
        
        if ($category !== 'all') {
            $query->whereHas('category', function($q) use ($category) {
                $q->where('slug', $category);
            });
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        $products = $query->with('category')->orderBy('id', 'desc')->paginate(12);
        $categories = ['all', 'elektronik', 'fashion', 'olahraga', 'rumah', 'buku', 'travel'];
        
        return view('products.index', compact('products', 'category', 'search', 'categories'));
    }

    public function show(int $id)
    {
        $product = Product::with('category')->findOrFail($id);
        
        // RECORD VIEW UNTUK TRACKING KLIK PRODUK
        $product->recordView();
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }
}