<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder {
    public function run(): void {
        Category::create(['kode_kategori' => 'KAT-IOT', 'nama_kategori' => 'Mikrokontroler & IoT', 'max_hari' => 3, 'max_unit' => 2, 'butuh_guru' => true]);
        Category::create(['kode_kategori' => 'KAT-NET', 'nama_kategori' => 'Alat Jaringan', 'max_hari' => 2, 'max_unit' => 2, 'butuh_guru' => false]);
        Category::create(['kode_kategori' => 'KAT-LPT', 'nama_kategori' => 'Laptop & PC', 'max_hari' => 1, 'max_unit' => 1, 'butuh_guru' => true]);
    }
}