<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');
        $search = $request->get('search', '');

        $products = Product::query()
            ->byCategory($category)
            ->search($search)
            ->orderBy('id', 'desc')
            ->paginate(12);

        $categories = ['all', 'elektronik', 'fashion', 'olahraga', 'rumah', 'buku', 'travel'];

        return view('products.index', compact('products', 'category', 'search', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}