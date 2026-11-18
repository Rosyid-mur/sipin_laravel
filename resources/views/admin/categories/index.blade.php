@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Manajemen Kategori</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola klasifikasi modul praktikum dan perangkat laboratorium.</p>
    </div>
    <!-- Tombol Buka Modal Tambah -->
    <button onclick="bukaModal('modal-tambah')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center shadow-sm">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Kategori
    </button>
</div>

<!-- Tabel Kategori -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-x-auto w-full">
    <table class="w-full text-left border-collapse whitespace-nowrap">
        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 font-medium">Kode</th>
                <th class="px-6 py-4 font-medium">Nama Kategori</th>
                <th class="px-6 py-4 font-medium">Total Aset</th>
                <th class="px-6 py-4 font-medium">Aturan Pinjam</th>
                <th class="px-6 py-4 font-medium text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm text-gray-700 dark:text-gray-300">
            @foreach($categories as $cat)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-4 font-semibold text-blue-600 dark:text-blue-400">{{ $cat->kode_kategori }}</td>
                <td class="px-6 py-4 font-medium">{{ $cat->nama_kategori }}</td>
                <td class="px-6 py-4">{{ $cat->inventories_count }} Unit</td>
                <td class="px-6 py-4">
                    <p>{{ $cat->max_hari }} Hari, Maks. {{ $cat->max_unit }} Unit</p>
                    @if($cat->butuh_guru)
                        <span class="inline-block mt-1 bg-purple-100 text-purple-700 px-2 py-0.5 rounded text-[10px] font-bold border border-purple-200">
                            Wajib Acc Guru
                        </span>
                    @endif
                </td>
                <!-- Bagian Aksi dipastikan menggunakan text-right -->
                <td class="px-6 py-4 text-right space-x-2">
                    <button type="button" class="btn-edit text-yellow-500 hover:text-yellow-600 font-medium" data-category="{{ json_encode($cat) }}">Edit</button>
                    <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" class="inline-block form-delete">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-600 font-medium">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ==================== MODAL TAMBAH KATEGORI ==================== -->
<!-- Perhatikan class "hidden" dan "items-center justify-center" -->
<div id="modal-tambah" class="hidden fixed inset-0 bg-black/60 z-50 items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">Tambah Kategori Baru</h2>
        </div>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="p-6 space-y-4 text-sm">
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Kode Kategori</label>
                    <input type="text" name="kode_kategori" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Nama Kategori</label>
                    <input type="text" name="nama_kategori" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Maks. Hari</label>
                        <input type="number" name="max_hari" value="3" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Maks. Unit</label>
                        <input type="number" name="max_unit" value="1" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="flex items-center mt-2">
                    <input type="checkbox" name="butuh_guru" id="butuh_guru" value="1" class="mr-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="butuh_guru" class="text-sm font-medium text-gray-700 dark:text-gray-300">Wajib Persetujuan Guru</label>
                </div>
            </div>
            <div class="p-4 border-t border-gray-100 dark:border-gray-700 flex justify-end space-x-2 bg-gray-50 dark:bg-gray-800/50 rounded-b-xl">
                <button type="button" onclick="tutupModal('modal-tambah')" class="px-4 py-2 border rounded-lg text-gray-700 dark:text-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL EDIT KATEGORI ==================== -->
<div id="modal-edit" class="hidden fixed inset-0 bg-black/60 z-50 items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">Edit Kategori</h2>
        </div>
        <form id="form-edit" method="POST">
            @csrf @method('PUT')
            <div class="p-6 space-y-4 text-sm">
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Kode Kategori</label>
                    <input type="text" name="kode_kategori" id="edit-kode" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="edit-nama" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Maks. Hari</label>
                        <input type="number" name="max_hari" id="edit-hari" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Maks. Unit</label>
                        <input type="number" name="max_unit" id="edit-unit" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="flex items-center mt-2">
                    <input type="checkbox" name="butuh_guru" id="edit-guru" value="1" class="mr-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                    <label for="edit-guru" class="text-sm font-medium text-gray-700 dark:text-gray-300">Wajib Persetujuan Guru</label>
                </div>
            </div>
            <div class="p-4 border-t border-gray-100 dark:border-gray-700 flex justify-end space-x-2 bg-gray-50 dark:bg-gray-800/50 rounded-b-xl">
                <button type="button" onclick="tutupModal('modal-edit')" class="px-4 py-2 border rounded-lg text-gray-700 dark:text-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Fungsi Buka/Tutup Modal
    function bukaModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).classList.add('flex');
    }
    function tutupModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).classList.remove('flex');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi Hapus
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({ 
                    title: 'Yakin hapus kategori ini?', 
                    text: "Pastikan kategori ini tidak memiliki barang terkait.",
                    icon: 'warning', 
                    showCancelButton: true, 
                    confirmButtonColor: '#EF4444', 
                    confirmButtonText: 'Ya, Hapus!' 
                }).then((result) => { 
                    if (result.isConfirmed) form.submit(); 
                });
            });
        });

        // Buka Modal Edit & Isi Data
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                let cat = JSON.parse(this.getAttribute('data-category'));
                
                document.getElementById('form-edit').action = '/categories/' + cat.id;
                document.getElementById('edit-kode').value = cat.kode_kategori;
                document.getElementById('edit-nama').value = cat.nama_kategori;
                document.getElementById('edit-hari').value = cat.max_hari;
                document.getElementById('edit-unit').value = cat.max_unit;
                document.getElementById('edit-guru').checked = (cat.butuh_guru == 1);
                
                bukaModal('modal-edit');
            });
        });
    });
</script>
@endpush