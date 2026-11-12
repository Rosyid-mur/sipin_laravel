<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus no_hp
            if (Schema::hasColumn('users', 'no_hp')) {
                $table->dropColumn('no_hp');
            }
            
            // Tambah kolom baru untuk profil
            if (!Schema::hasColumn('users', 'no_absen')) {
                $table->string('no_absen')->nullable()->after('kelas');
                $table->string('mata_pelajaran')->nullable()->after('no_absen');
                $table->string('jabatan')->nullable()->after('mata_pelajaran');
                $table->string('unit_kerja')->nullable()->after('jabatan');
                $table->enum('status_akun', ['Aktif', 'Nonaktif'])->default('Aktif')->after('unit_kerja');
            }
        });

        // BAGIAN INVENTARIS KITA HAPUS KARENA KOLOM GAMBAR SUDAH ADA
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_absen', 'mata_pelajaran', 'jabatan', 'unit_kerja', 'status_akun']);
            $table->string('no_hp')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
    if (!Schema::hasColumn('users', 'no_hp')) {
        $table->string('no_hp')->nullable()->after('status_akun');
    }
        });
    }
    
};