<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tiket</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed; /* Agar tabel bisa menyesuaikan lebar kolom */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            word-wrap: break-word; /* Agar teks yang panjang bisa dibungkus di dalam sel */
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Tiket</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Email</th>
                <th>Nama</th>
                <th>Judul Keluhan</th>
                <th>Kategori</th> <!-- Kolom kategori -->
                <th>Permission Status</th>
                <th>Alasan Ditolak</th>
                <th>Status Progress</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop untuk menampilkan semua tiket dari berbagai kategori --}}
            @foreach($categories as $categoryName => $ticketsInCategory)
                @foreach($ticketsInCategory as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->tanggal ? \Carbon\Carbon::parse($ticket->tanggal)->format('d/m/Y') : 'Tanggal tidak tersedia' }}</td>
                    <td>{{ $ticket->email }}</td>
                    <td>{{ $ticket->name }}</td>
                    <td>{{ $ticket->judul }}</td>
                    <td>{{ $categoryName }}</td> <!-- Menampilkan kategori di kolom kategori -->
                    <td>{{ $ticket->permission_status }}</td>
                    <td>{{ $ticket->reject_reason ?? '-' }}</td>
                    <td>{{ $ticket->progress_status }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

</body>
</html>
