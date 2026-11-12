<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;
use App\Models\Category;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan Anda sudah punya Kategori 'Alat Lab' di CategorySeeder
        $katElektronik = Category::firstOrCreate(['kode_kategori' => 'KAT-ELK'], ['nama_kategori' => 'Alat Elektronik', 'max_hari' => 3, 'max_unit' => 2]);
        $katAlat = Category::firstOrCreate(['kode_kategori' => 'KAT-ALT'], ['nama_kategori' => 'Alat Manual', 'max_hari' => 3, 'max_unit' => 1]);

        $inventaris = [
            ['kategori' => $katElektronik->id, 'nama' => 'Laptop HP', 'stok' => 3],
            ['kategori' => $katElektronik->id, 'nama' => 'Flasdisk', 'stok' => 10],
            ['kategori' => $katElektronik->id, 'nama' => 'Mouse', 'stok' => 20],
            ['kategori' => $katElektronik->id, 'nama' => 'Keyboard', 'stok' => 10],
            ['kategori' => $katElektronik->id, 'nama' => 'Proyektor', 'stok' => 3],
            ['kategori' => $katElektronik->id, 'nama' => 'Monitor', 'stok' => 3],
            ['kategori' => $katAlat->id, 'nama' => 'Obeng mini', 'stok' => 1],
            ['kategori' => $katElektronik->id, 'nama' => 'Arduino uno', 'stok' => 30],
            ['kategori' => $katAlat->id, 'nama' => 'Solder', 'stok' => 1],
            ['kategori' => $katAlat->id, 'nama' => 'Bor tembok', 'stok' => 1],
            ['kategori' => $katElektronik->id, 'nama' => 'Bor mini listrik', 'stok' => 1],
            ['kategori' => $katElektronik->id, 'nama' => 'Spiker', 'stok' => 1],
            ['kategori' => $katElektronik->id, 'nama' => 'Mic + sound', 'stok' => 1],
        ];

        foreach ($inventaris as $i => $item) {
            Inventory::create([
                'category_id' => $item['kategori'],
                'kode_inventaris' => 'INV-RPL-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'nama_alat' => $item['nama'],
                'deskripsi' => 'Inventaris Lab RPL',
                'stok_total' => $item['stok'],
                'stok_tersedia' => $item['stok'],
                'stok_dipinjam' => 0,
                'stok_rusak' => 0,
                'kondisi' => 'Baik',
                'lokasi' => 'Ruang Lab RPL',
            ]);
        }
    }
}