<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('inventories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
        $table->string('kode_inventaris')->unique();
        $table->string('nama_alat');
        $table->text('deskripsi')->nullable();
        $table->integer('stok_total')->default(0);
        $table->integer('stok_tersedia')->default(0);
        $table->integer('stok_dipinjam')->default(0);
        $table->integer('stok_rusak')->default(0);
        $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
        $table->string('lokasi');
        $table->string('gambar')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
