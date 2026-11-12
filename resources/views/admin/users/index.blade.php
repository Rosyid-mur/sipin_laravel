@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Manajemen Pengguna</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola data siswa, guru, dan staf laboratorium.</p>
    </div>
    <button onclick="bukaModal('modal-tambah')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center shadow-sm">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Pengguna
    </button>
</div>

<!-- Filter & Search -->
<div class="bg-white dark:bg-gray-800 p-4 rounded-t-xl border-b border-gray-100 dark:border-gray-700 flex flex-col md:flex-row justify-between items-center gap-4">
    <form action="{{ route('users.index') }}" method="GET" class="flex items-center w-full md:w-auto gap-2">
        <input type="hidden" name="role" value="{{ $role }}">
        <div class="relative w-full md:w-64">
            <i data-lucide="search" class="w-4 h-4 absolute left-3 top-2.5 text-gray-400"></i>
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, NIS/NIP..." class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
        </div>
        <button type="submit" class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-600">Cari</button>
    </form>
    
    <div class="flex space-x-1 bg-gray-100 dark:bg-gray-700 p-1 rounded-lg">
        <a href="{{ route('users.index', ['role' => 'siswa']) }}" class="px-3 py-1.5 text-sm font-medium rounded-md {{ $role == 'siswa' ? 'bg-white dark:bg-gray-800 shadow-sm text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-300' }}">Siswa</a>
        <a href="{{ route('users.index', ['role' => 'guru']) }}" class="px-3 py-1.5 text-sm font-medium rounded-md {{ $role == 'guru' ? 'bg-white dark:bg-gray-800 shadow-sm text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-300' }}">Guru</a>
        <a href="{{ route('users.index', ['role' => 'admin']) }}" class="px-3 py-1.5 text-sm font-medium rounded-md {{ $role == 'admin' ? 'bg-white dark:bg-gray-800 shadow-sm text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-300' }}">Admin</a>
    </div>
</div>

<!-- Tabel Data -->
<div class="bg-white dark:bg-gray-800 rounded-b-xl shadow-sm border border-t-0 border-gray-100 dark:border-gray-700 overflow-x-auto">
    <table class="w-full text-left border-collapse whitespace-nowrap">
        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 font-medium">Nama Lengkap</th>
                <th class="px-6 py-4 font-medium">NIS / NIP</th>
                <th class="px-6 py-4 font-medium">Kelas / Role</th>
                <th class="px-6 py-4 font-medium text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm text-gray-700 dark:text-gray-300">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        @if($user->foto_profil)
                            <img src="{{ Storage::url($user->foto_profil) }}" class="w-8 h-8 rounded-full object-cover mr-3">
                        @else
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold mr-3">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                        <span class="font-semibold text-gray-800 dark:text-white">{{ $user->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 font-medium">{{ $user->username }}</td>
                <td class="px-6 py-4">{{ $user->kelas ?? ucfirst($user->role) }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <button type="button" class="btn-edit text-yellow-500 hover:text-yellow-600 font-medium" data-user="{{ json_encode($user) }}">Edit</button>
                    
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block form-delete">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-600 font-medium">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">Data tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
        {{ $users->appends(['role' => $role, 'search' => $search])->links() }}
    </div>
</div>

<!-- ==================== MODAL TAMBAH PENGGUNA ==================== -->
<div id="modal-tambah" class="hidden fixed inset-0 bg-black/60 z-50 items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-lg">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">Tambah Pengguna Baru</h2>
        </div>
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-6 grid grid-cols-2 gap-4 text-sm">
                <div class="col-span-2">
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Username (NIS/NIP)</label>
                    <input type="text" name="username" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input type="password" name="password" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Role</label>
                    <select name="role" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="siswa">Siswa</option>
                        <option value="guru">Guru</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Kelas (Jika Siswa)</label>
                    <input type="text" name="kelas" placeholder="Contoh: XII RPL C" class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-2">
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Foto Profil (Opsional)</label>
                    <input type="file" name="foto_profil" accept="image/*" class="w-full border p-2 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
            </div>
            <div class="p-4 border-t border-gray-100 dark:border-gray-700 flex justify-end space-x-2 bg-gray-50 dark:bg-gray-800/50 rounded-b-xl">
                <button type="button" onclick="tutupModal('modal-tambah')" class="px-4 py-2 border rounded-lg text-gray-700 dark:text-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL EDIT PENGGUNA ==================== -->
<div id="modal-edit" class="hidden fixed inset-0 bg-black/60 z-50 items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-lg">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">Edit Pengguna</h2>
        </div>
        <form id="form-edit" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="p-6 grid grid-cols-2 gap-4 text-sm">
                <div class="col-span-2">
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                    <input type="text" name="name" id="edit-name" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Username (NIS/NIP)</label>
                    <input type="text" name="username" id="edit-username" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Password Baru</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Role</label>
                    <select name="role" id="edit-role" required class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="siswa">Siswa</option>
                        <option value="guru">Guru</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Kelas</label>
                    <input type="text" name="kelas" id="edit-kelas" class="w-full border p-2.5 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-2">
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Ganti Foto Profil</label>
                    <input type="file" name="foto_profil" accept="image/*" class="w-full border p-2 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
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
                    title: 'Yakin hapus pengguna ini?', 
                    text: "Data yang dihapus tidak bisa dikembalikan.",
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
                let user = JSON.parse(this.getAttribute('data-user'));
                
                document.getElementById('form-edit').action = '/admin/users/' + user.id;
                document.getElementById('edit-name').value = user.name;
                document.getElementById('edit-username').value = user.username;
                document.getElementById('edit-role').value = user.role;
                document.getElementById('edit-kelas').value = user.kelas || '';
                
                bukaModal('modal-edit');
            });
        });
    });
</script>
@endpush