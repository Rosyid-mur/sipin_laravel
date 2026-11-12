<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('inventories')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori' => 'required|unique:categories,kode_kategori|max:20',
            'nama_kategori' => 'required|max:100',
            'deskripsi' => 'nullable',
            'max_hari' => 'required|integer|min:1',
            'max_unit' => 'required|integer|min:1',
        ]);

        Category::create([
            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
            'max_hari' => $request->max_hari,
            'max_unit' => $request->max_unit,
            'butuh_guru' => $request->has('butuh_guru'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'kode_kategori' => 'required|max:20|unique:categories,kode_kategori,' . $category->id,
            'nama_kategori' => 'required|max:100',
            'max_hari' => 'required|integer|min:1',
            'max_unit' => 'required|integer|min:1',
        ]);

        $category->update([
            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
            'max_hari' => $request->max_hari,
            'max_unit' => $request->max_unit,
            'butuh_guru' => $request->has('butuh_guru'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        if ($category->inventories()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki data inventaris!');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}