<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; // Tambahkan ini
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase; // Aktifkan ini agar tabel otomatis dibuat saat test

    public function test_halaman_utama_redirect_ke_login(): void
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_siswa_tidak_bisa_akses_halaman_admin(): void
    {
        // Buat user dummy
        $siswa = User::create([
            'name' => 'Siswa Test',
            'username' => 'test123',
            'password' => bcrypt('password123'),
            'role' => 'siswa',
        ]);

        $response = $this->actingAs($siswa)->get('/admin/peminjaman');
        $response->assertStatus(403); // Forbidden
    }
}