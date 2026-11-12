<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // Default Lunas, karena jika tidak telat, dendanya 0.
            $table->enum('status_denda', ['Belum Lunas', 'Lunas'])->default('Lunas')->after('denda');
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('status_denda');
        });
    }
};