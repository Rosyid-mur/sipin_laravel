<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'jabatan' => 'Petugas Toolman',
            'unit_kerja' => 'Laboratorium RPL SMK Negeri 5 Surakarta',
            'status_akun' => 'Aktif'
        ]);

        // 2. Guru (Diperbarui sesuai permintaan)
        User::create([
            'name' => 'Kurniasari, S.Pd, S.Kom',
            'username' => '198406292010012028', 
            'password' => Hash::make('password123'),
            'role' => 'guru',
            'mata_pelajaran' => 'Pemrograman Perangkat Bergerak',
            'status_akun' => 'Aktif'
        ]);
        User::create([
            'name' => 'Dwi Esti Wardani, S.Pd, S.Kom',
            'username' => '197909142008012011', 
            'password' => Hash::make('password123'),
            'role' => 'guru',
            'mata_pelajaran' => 'Pemrograman Berbasis Teks, Grafis, dan Multimedia',
            'status_akun' => 'Aktif'
        ]);

        // 3. 32 Siswa XII RPL C (Data Riil)
        $siswa = [
            ['nis' => '24122', 'nama' => 'Abdul Aziz Nurrahman'],
            ['nis' => '24123', 'nama' => 'Adiputra Arya Sena'],
            ['nis' => '24124', 'nama' => 'Alvin Yourry Putra Mentari'],
            ['nis' => '24125', 'nama' => 'Amadeo Brian Ranastya Putra'],
            ['nis' => '24127', 'nama' => 'Andreas Kelvin Anasta Putra'],
            ['nis' => '24128', 'nama' => 'Anjeli Afifah Darajati'],
            ['nis' => '24129', 'nama' => 'Azriel Aida Nurochim'],
            ['nis' => '24130', 'nama' => 'Bintang Fahri Hascarya'],
            ['nis' => '24131', 'nama' => 'Carisha Amira Insani'],
            ['nis' => '24132', 'nama' => 'Chelsea Muhammad Adli'],
            ['nis' => '24133', 'nama' => 'Christian Wardana'],
            ['nis' => '24134', 'nama' => 'Cleodora Bertha Fortuna'],
            ['nis' => '24135', 'nama' => 'Cristiano Vieli Kaligis'],
            ['nis' => '24136', 'nama' => 'Daffa Farah Irfanudin'],
            ['nis' => '24137', 'nama' => 'Desta Tiar Redriana'],
            ['nis' => '24138', 'nama' => 'Farrel Brilliant Nugroho'],
            ['nis' => '24139', 'nama' => 'Fida Qurotu Aini'],
            ['nis' => '24140', 'nama' => 'Ghozi Mumtaza Hanif'],
            ['nis' => '24141', 'nama' => 'Irfan Aji Wardana'],
            ['nis' => '24142', 'nama' => 'Manestiko Banyubiru'],
            ['nis' => '24144', 'nama' => 'Michael Aditya'],
            ['nis' => '24145', 'nama' => 'Moses Adi Saputra'],
            ['nis' => '24146', 'nama' => 'Muhammad Anshori'],
            ['nis' => '24147', 'nama' => 'Muhammad Fahri Rahman Arrafi'],
            ['nis' => '24148', 'nama' => 'Muhammad Rosyid Muryanto'],
            ['nis' => '24149', 'nama' => 'Nicholas Gusti Saputra'],
            ['nis' => '24150', 'nama' => 'Pranaja Abi Praya Widiyatama'],
            ['nis' => '24151', 'nama' => 'Ramaditya Surya Putra'],
            ['nis' => '24152', 'nama' => 'Sabian Apta Arira'],
            ['nis' => '24153', 'nama' => 'Satria Rahmansyah'],
            ['nis' => '24154', 'nama' => 'Theodoric Bakuh Panggalih'],
            ['nis' => '24155', 'nama' => 'Xian Adi Nugroho'],
        ];

        foreach ($siswa as $index => $s) {
            User::create([
                'name' => $s['nama'],
                'username' => $s['nis'],
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'kelas' => 'XII RPL C',
                'no_absen' => $index + 1,
                'status_akun' => 'Aktif',
            ]);
        }
    }
}