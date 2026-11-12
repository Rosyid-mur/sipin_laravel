<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Category;
use App\Models\ActivityLog; // Tambahan untuk Log
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventory::with('category');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_alat', 'like', '%' . $request->search . '%')
                ->orWhere('kode_inventaris', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $inventories = $query->latest()->paginate(10)->appends($request->all());
        
        $categories = \App\Models\Category::all();
        $total_katalog = Inventory::count();
        $siap_digunakan = Inventory::sum('stok_tersedia');
        $sedang_dipinjam = Inventory::sum('stok_dipinjam');
        $perlu_perbaikan = Inventory::sum('stok_rusak');

        return view('admin.inventories.index', compact('inventories', 'categories', 'total_katalog', 'siap_digunakan', 'sedang_dipinjam', 'perlu_perbaikan'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.inventories.create', compact('categories'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_alat' => 'required|max:150',
            'stok_total' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // AUTO GENERATE KODE INVENTARIS
        $lastInventory = Inventory::latest('id')->first();
        $nextId = $lastInventory ? $lastInventory->id + 1 : 1;
        $kode_inventaris = 'INV-RPL-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        $data = $request->except('gambar', 'kode_inventaris');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('inventories', 'public');
        }

        Inventory::create(array_merge($data, [
            'kode_inventaris' => $kode_inventaris,
            'stok_tersedia' => $request->stok_total,
            'stok_dipinjam' => 0,
            'stok_rusak' => 0,
        ]));

        // Catat Log
        ActivityLog::record('Tambah Inventaris', 'Menambahkan barang baru: ' . $request->nama_alat);

        return redirect()->route('inventories.index')->with('success', 'Data inventaris berhasil ditambahkan!');
    }

    public function edit(Inventory $inventory)
    {
        $categories = Category::all();
        return view('admin.inventories.edit', compact('inventory', 'categories'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'kode_inventaris' => 'required|max:50|unique:inventories,kode_inventaris,' . $inventory->id,
            'nama_alat' => 'required|max:150',
            'stok_total' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('gambar');
        $selisih_stok = $request->stok_total - $inventory->stok_total;
        
        if ($request->hasFile('gambar')) {
            if ($inventory->gambar) {
                \Storage::disk('public')->delete($inventory->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('inventories', 'public');
        }

        $inventory->update([
            'category_id' => $request->category_id,
            'kode_inventaris' => $request->kode_inventaris,
            'nama_alat' => $request->nama_alat,
            'deskripsi' => $request->deskripsi,
            'stok_total' => $request->stok_total,
            'stok_tersedia' => $inventory->stok_tersedia + $selisih_stok,
            'kondisi' => $request->kondisi,
            'lokasi' => $request->lokasi,
            'gambar' => $data['gambar'] ?? $inventory->gambar,
        ]);

        // Catat Log
        ActivityLog::record('Edit Inventaris', 'Mengubah data barang: ' . $request->nama_alat);

        return redirect()->route('inventories.index')->with('success', 'Data inventaris berhasil diperbarui!');
    }

    public function destroy(Inventory $inventory)
    {
        if ($inventory->stok_dipinjam > 0) {
            return redirect()->route('inventories.index')->with('error', 'Inventaris tidak dapat dihapus karena sedang dipinjam!');
        }
        
        if ($inventory->gambar) {
            \Storage::disk('public')->delete($inventory->gambar);
        }
        
        // Catat Log Sebelum Hapus
        ActivityLog::record('Hapus Inventaris', 'Menghapus barang: ' . $inventory->nama_alat);

        $inventory->delete();
        return redirect()->route('inventories.index')->with('success', 'Data inventaris berhasil dihapus!');
    }

    public function printQr(Inventory $inventory)
    {
        return view('admin.inventories.qr', compact('inventory'));
    }
}