<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('username')->unique(); // Tambahan kolom username
        $table->enum('role', ['admin', 'guru', 'siswa'])->default('siswa');
        $table->string('kelas')->nullable();
        $table->string('no_hp')->nullable();
    });
}
public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role', 'kelas', 'no_hp']);
    });
}
};