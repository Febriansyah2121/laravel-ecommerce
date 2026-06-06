<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')->orderBy('id', 'desc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'slug' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50'
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(int $id): View  // ← tambah tipe int
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, int $id): RedirectResponse  // ← tambah tipe int
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'slug' => 'required|string|max:255|unique:categories,slug,' . $id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50'
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy(int $id): RedirectResponse  // ← tambah tipe int
    {
        $category = Category::findOrFail($id);
        
        // Update products to set category_id = null
        Product::where('category_id', $id)->update(['category_id' => null]);
        
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}