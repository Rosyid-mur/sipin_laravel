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
    Schema::create('loans', function (Blueprint $table) {
        $table->id();
        $table->string('kode_transaksi')->unique();
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('guru_id')->nullable()->constrained('users')->nullOnDelete();
        $table->date('tgl_pinjam');
        $table->date('tgl_kembali_rencana');
        $table->date('tgl_kembali_aktual')->nullable();
        $table->text('keperluan');
        $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Borrowed', 'Returned'])->default('Pending');
        $table->text('catatan_admin')->nullable();
        $table->integer('denda')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
