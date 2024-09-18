<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            display: block;
            margin: 20px auto;
            max-width: 400px;
            max-height: 300px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        p {
            margin: 10px 0;
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

    <!-- Dokumentasi Sebelum Maintenance -->
    @if ($jadwal->foto)
        <p><strong>Dokumentasi Sebelum Maintenance:</strong></p>
        @php
            // Pisahkan foto yang dipisahkan oleh koma menjadi array
            $fotoSebelumArray = explode(',', $jadwal->foto);
        @endphp
        @foreach ($fotoSebelumArray as $foto)
            <img src="{{ public_path('storage/fotos/' . trim($foto)) }}" alt="Foto Sebelum Maintenance">
        @endforeach
    @endif

    <!-- Dokumentasi Setelah Maintenance -->
    @if ($jadwal->foto_kedua)
        <p><strong>Dokumentasi Setelah Maintenance:</strong></p>
        @php
            // Pisahkan foto kedua yang dipisahkan oleh koma menjadi array
            $fotoSesudahArray = explode(',', $jadwal->foto_kedua);
        @endphp
        @foreach ($fotoSesudahArray as $foto_kedua)
            <img src="{{ public_path('storage/fotos/' . trim($foto_kedua)) }}" alt="Foto Setelah Maintenance">
        @endforeach
    @endif
</body>
</html>
