@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Log Aktivitas Sistem</h1>
    <p class="text-sm text-gray-500">Riwayat tindakan yang dilakukan oleh Admin/Petugas.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-50 border-b text-gray-500 uppercase text-xs">
                <tr>
                    <th class="p-4 font-medium">Waktu</th>
                    <th class="p-4 font-medium">Admin</th>
                    <th class="p-4 font-medium">Aksi</th>
                    <th class="p-4 font-medium">Keterangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 text-gray-500">{{ $log->created_at->format('d M Y, H:i') }}</td>
                    <td class="p-4 font-bold text-gray-800">{{ $log->user->name }}</td>
                    <td class="p-4"><span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-bold">{{ $log->action }}</span></td>
                    <td class="p-4 text-gray-600">{{ $log->description }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="p-8 text-center text-gray-500">Belum ada aktivitas yang tercatat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-gray-100">{{ $logs->links() }}</div>
</div>
@endsection