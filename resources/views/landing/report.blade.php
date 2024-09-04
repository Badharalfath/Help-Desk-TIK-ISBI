<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Maintenance Report</h1>
    <p><strong>Tanggal:</strong> {{ $jadwal->tanggal }}</p>
    <p><strong>Kegiatan:</strong> {{ $jadwal->kegiatan }}</p>
    <p><strong>Waktu:</strong> {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_berakhir }}</p>
    <p><strong>Deskripsi:</strong></p>
    <p>{{ $jadwal->deskripsi }}</p>
    
    @if ($jadwal->foto)
        <p><strong>Dokumentasi:</strong></p>
        <img src="{{ public_path('storage/fotos/' . $jadwal->foto) }}" style="width: 100%; max-width: 600px;">
    @endif
</body>
</html>
