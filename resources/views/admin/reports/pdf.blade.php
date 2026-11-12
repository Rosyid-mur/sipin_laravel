<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header h2 { margin: 5px 0; font-size: 16px; }
        .header p { margin: 0; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #000; }
        th { background-color: #f2f2f2; padding: 8px; text-align: center; }
        td { padding: 8px; }
        .ttd { width: 100%; margin-top: 30px; text-align: right; }
        .ttd div { display: inline-block; text-align: center; width: 250px; }
        .ttd p { margin: 0; padding: 5px; }
    </style>
</head>
<body>

    <!-- KOP SURAT -->
    <div class="header">
        <h1>PEMERINTAH PROVINSI JAWA TENGAH</h1>
        <h2>SEKOLAH MENENGAH KEJURUAN NEGERI 5 SURAKARTA</h2>
        <p>Jl. Adi Sucipto No. 42, Jajar, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57144</p>
        <p>Telepon: (0271) 711457 | Laman: smkn5solo.sch.id</p>
    </div>

    <h3 style="text-align: center; margin-bottom: 20px;">LAPORAN PEMINJAMAN INVENTARIS LABORATORIUM RPL</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode TRX</th>
                <th>Peminjam</th>
                <th>Barang (Jml)</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $index => $loan)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $loan->kode_transaksi }}</td>
                <td>{{ $loan->user->name }}</td>
                <td>{{ $loan->details->first()->inventory->nama_alat ?? '-' }} ({{ $loan->details->first()->jumlah ?? 0 }})</td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($loan->tgl_pinjam)->format('d/m/Y') }}</td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($loan->tgl_kembali_rencana)->format('d/m/Y') }}</td>
                <td style="text-align: center;">{{ $loan->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TANDA TANGAN -->
    <div class="ttd">
        <div>
            <p>Surakarta, {{ date('d F Y') }}</p>
            <p>Kepala Laboratorium RPL</p>
            <br><br><br><br>
            <p style="text-decoration: underline; font-weight: bold;">Admin Toolman RPL</p>
            <p>NIP. ........................</p>
        </div>
    </div>

</body>
</html>