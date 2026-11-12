<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - SIPIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center p-4">
    <div class="text-center">
        <h1 class="text-9xl font-bold text-red-500">403</h1>
        <h2 class="text-2xl font-bold text-gray-800 mt-4 mb-2">Akses Ditolak</h2>
        <p class="text-gray-500 mb-6">Maaf, Anda tidak memiliki hak akses untuk membuka halaman ini.</p>
        <a href="{{ url('/dashboard') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition">Kembali ke Dashboard</a>
    </div>
</body>
</html>