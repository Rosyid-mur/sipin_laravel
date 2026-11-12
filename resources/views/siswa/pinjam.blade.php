@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Form Pengajuan Peminjaman</h1>
    <div class="bg-white p-6 rounded-xl shadow-sm border">
        <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-100">
            <h3 class="font-bold text-blue-800">{{ $inventory->nama_alat }}</h3>
            <p class="text-sm text-blue-600">Stok tersedia: {{ $inventory->stok_tersedia }} unit</p>
        </div>
        <form action="{{ route('siswa.simpan', $inventory->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Jumlah Pinjam</label>
                <input type="number" name="jumlah" value="1" min="1" max="{{ $inventory->stok_tersedia }}" class="w-full border p-2 rounded-lg" required>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Tanggal Mulai</label>
                    <input type="date" name="tgl_pinjam" value="{{ date('Y-m-d') }}" class="w-full border p-2 rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Rencana Kembali</label>
                    <input type="date" name="tgl_kembali_rencana" value="{{ date('Y-m-d', strtotime('+3 days')) }}" class="w-full border p-2 rounded-lg" required>
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Keperluan Praktikum</label>
                <textarea name="keperluan" rows="3" class="w-full border p-2 rounded-lg" placeholder="Contoh: Praktikum IoT Sensor Suhu" required></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-bold hover:bg-blue-700">Kirim Pengajuan</button>
        </form>
    </div>
</div>
@endsection