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
            margin-bottom: 10px;
            text-align: left;
        }

        .kop-surat img {
            width: 100px;
            height: auto;
            margin-right: 15px;
        }

        .kop-teks {
            text-align: center;
            flex: 1;
        }

        .kop-teks h1,
        .kop-teks h2,
        .kop-teks p {
            margin: 0;
            padding: 0;
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
        <img src="https://upload.wikimedia.org/wikipedia/id/9/9d/Logo_Institut_Seni_Budaya_Indonesia_Bandung.png"
            alt="Logo ISBI Bandung">
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
                <th>Kode Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Keterangan</th>
                <th>Nama Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $item)
                <tr>
                    <td>{{ $item->kd_transaksi }}</td>
                    <td>{{ $item->tgl_transaksi }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ $item->nama_barang }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
