<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // ... kode store
    }

    public function show(int $id)  // ← tambah tipe int
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit(int $id)  // ← tambah tipe int
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, int $id)  // ← tambah tipe int
    {
        // ... kode update
    }

    public function destroy(int $id)  // ← tambah tipe int
    {
        // ... kode destroy
    }
}