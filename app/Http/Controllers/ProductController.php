<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request): View
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
        
        /** @var LengthAwarePaginator $products */
        $products = $query->with('category')->orderBy('id', 'desc')->paginate(12);
        $categories = ['all', 'elektronik', 'fashion', 'olahraga', 'rumah', 'buku', 'travel'];
        
        return view('products.index', compact('products', 'category', 'search', 'categories'));
    }

    /**
     * Display the specified product.
     */
    public function show(int $id): View
    {
        $product = Product::with('category')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }
}