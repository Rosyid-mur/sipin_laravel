@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Hasil Pencarian: "{{ $keyword }}"</h1>
</div>

@if(!$keyword)
    <p class="text-gray-500">Silakan masukkan kata kunci di kolom pencarian atas.</p>
@else
    <div class="space-y-6">
        <!-- Hasil Inventaris -->
        @if(count($inventories) > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h2 class="font-bold text-lg mb-3 text-blue-600">Inventaris ({{ count($inventories) }})</h2>
            <ul class="divide-y divide-gray-100">
                @foreach($inventories as $inv)
                <li class="py-2"><a href="{{ auth()->user()->role == 'admin' ? route('inventories.index', ['search' => $inv->nama_alat]) : route('siswa.detail', $inv->id) }}" class="hover:underline">{{ $inv->nama_alat }} <span class="text-gray-500 text-sm">({{ $inv->kode_inventaris }})</span></a></li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Hasil Transaksi -->
        @if(count($loans) > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h2 class="font-bold text-lg mb-3 text-orange-600">Transaksi ({{ count($loans) }})</h2>
            <ul class="divide-y divide-gray-100">
                @foreach($loans as $loan)
                <li class="py-2"><a href="{{ route('admin.loans.index', ['search' => $loan->kode_transaksi]) }}" class="hover:underline">{{ $loan->kode_transaksi }} <span class="text-gray-500 text-sm">(Status: {{ $loan->status }})</span></a></li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Hasil Pengguna -->
        @if(count($users) > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h2 class="font-bold text-lg mb-3 text-green-600">Pengguna ({{ count($users) }})</h2>
            <ul class="divide-y divide-gray-100">
                @foreach($users as $user)
                <li class="py-2"><a href="{{ route('users.index', ['search' => $user->name]) }}" class="hover:underline">{{ $user->name }} <span class="text-gray-500 text-sm">({{ $user->username }})</span></a></li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(count($inventories) == 0 && count($loans) == 0 && count($users) == 0)
            <div class="text-center py-10 bg-white rounded-xl border border-gray-100">
                <i data-lucide="search-x" class="w-12 h-12 text-gray-300 mx-auto mb-2"></i>
                <p class="text-gray-500">Tidak ada data yang cocok dengan kata kunci tersebut.</p>
            </div>
        @endif
    </div>
@endif
@endsection