<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bukti Serah Terima Aset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin-top: 20px;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            /* Menjaga elemen tetap sejajar secara vertikal */
            margin-bottom: 10px;
        }

        .kop-surat img {
            width: 70px;
            /* Mengatur ukuran gambar sedikit lebih kecil */
            height: auto;
            margin-right: 15px;
            /* Jarak antara logo dan teks */
        }

        .kop-teks {
            flex: 1;
            text-align: left;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Menjaga teks tetap rata di tengah secara vertikal */
        }

        .kop-teks h1,
        .kop-teks h2,
        .kop-teks p {
            margin: 0;
            padding: 0;
            line-height: 1.2;
            /* Mengurangi line-height agar lebih kompak */
        }

        .kop-teks h1 {
            font-size: 16px;
            font-weight: bold;
        }

        .kop-teks h2 {
            font-size: 14px;
            font-weight: bold;
        }

        .kop-teks p {
            font-size: 12px;
            margin-top: 4px;
        }

        .kop-teks hr {
            border: 1px solid black;
            margin-top: 5px;
        }

        .header-title {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .alamat {
            font-size: 12px;
            margin-top: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>

</head>

<body>

    <div class="kop-surat">
        <img src="{{ $logoBase64 }}" alt="Logo ISBI Bandung" style="width: 100px; height: auto;">
        <div class="kop-teks">
            <h1>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h1>
            <h2>INSTITUT SENI BUDAYA INDONESIA BANDUNG</h2>
            <h2>UPA TEKNOLOGI INFORMASI DAN KOMUNIKASI</h2>
            <p class="alamat">
                Jalan Buahbatu Nomor 212 Bandung 40265<br>
                Telepon (022) 7314982, 7394532 - Faksimili (022) 7303021 Laman: <a href="https://isbi.ac.id"
                    target="_blank">isbi.ac.id</a>
            </p>
            <hr>
        </div>
    </div>

    <div class="header-title">Bukti Serah Terima Aset</div>

    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $item)
                <tr>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ $item->jumlah }}</td> <!-- Mengambil kolom jumlah -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
