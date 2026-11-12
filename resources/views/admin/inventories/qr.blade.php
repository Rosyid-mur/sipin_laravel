<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>QR Code - {{ $inventory->nama_alat }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { background: white; }
            .no-print { display: none !important; }
            .qr-card { border: 2px dashed #000 !important; }
        }
    </style>
</head>
<body class="bg-gray-100 p-10 flex flex-col items-center justify-center min-h-screen">
    
    <div class="mb-6 no-print text-center">
        <h2 class="text-xl font-bold mb-2">Label QR Code Inventaris</h2>
        <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold shadow hover:bg-blue-700">Cetak Label</button>
        <a href="javascript:window.close();" class="ml-2 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg font-medium transition-colors">
    Tutup & Kembali
</a>
    </div>

    <!-- Area Label yang akan dicetak -->
    <div class="qr-card bg-white p-6 rounded-xl shadow-lg border border-gray-300 w-87.5 text-center">
        <h1 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-1">LAB RPL SMKN 5 SURAKARTA</h1>
        <hr class="mb-4 border-gray-200">
        
        <div class="flex justify-center mb-4">
            <!-- Generate QR Code (Data: Kode Inventaris) -->
            {!! QrCode::size(180)->generate(route('inventories.index') . '?search=' . $inventory->kode_inventaris) !!}
        </div>
        
        <h2 class="text-lg font-bold text-gray-800 leading-tight mb-1">{{ $inventory->nama_alat }}</h2>
        <p class="text-sm font-semibold text-blue-600 mb-2">{{ $inventory->kode_inventaris }}</p>
        
        <div class="bg-gray-100 rounded-lg p-2 mt-4 text-xs text-gray-600">
            <p><strong>Kategori:</strong> {{ $inventory->category->nama_kategori }}</p>
            <p><strong>Lokasi:</strong> {{ $inventory->lokasi }}</p>
        </div>
    </div>

</body>
</html>