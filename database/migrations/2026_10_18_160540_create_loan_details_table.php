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
    Schema::create('loan_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('loan_id')->constrained('loans')->cascadeOnDelete();
        $table->foreignId('inventory_id')->constrained('inventories')->cascadeOnDelete();
        $table->integer('jumlah');
        $table->enum('kondisi_kembali', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->nullable();
        $table->text('catatan_kondisi')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_details');
    }
};
