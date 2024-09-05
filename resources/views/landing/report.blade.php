<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px; /* Added margin for better spacing */
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
            margin: 20px auto; /* Centers the image */
            max-width: 500px; /* Ensures image is not too wide */
            max-height: 400px; /* Ensures image is not too tall */
            border: 1px solid #ddd; /* Adds a border around the image */
            border-radius: 5px; /* Slightly rounded corners */
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

    @if ($jadwal->foto)
        <p><strong>Dokumentasi Sebelum Maintenance:</strong></p>
        <img src="{{ public_path('storage/fotos/' . $jadwal->foto) }}" alt="Foto Sebelum Maintenance">
    @endif

    @if ($jadwal->foto_kedua)
        <p><strong>Dokumentasi Setelah Maintenance:</strong></p>
        <img src="{{ public_path('storage/fotos/' . $jadwal->foto_kedua) }}" alt="Foto Setelah Maintenance">
    @endif
</body>
</html>
