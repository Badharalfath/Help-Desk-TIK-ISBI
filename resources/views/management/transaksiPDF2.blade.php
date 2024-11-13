<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bukti Serah Terima Aset</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
            margin-top: 20px;
            position: relative;
            min-height: 100vh;
        }

        .kop-surat {
            position: relative;
            margin-bottom: 10px;
            text-align: center;
        }

        .kop-surat img {
            position: absolute;
            top: -15px;
            left: 10px;
            width: 110px;
            height: auto;
        }

        .kop-teks {
            display: inline-block;
            margin-left: 120px;
            text-align: center;
        }

        .kop-teks h1,
        .kop-teks h2,
        .kop-teks p {
            margin: 0;
            padding: 0;
            line-height: 1.2;
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

        .kop-surat hr {
            border: 1px solid black;
            margin: 30px 0 0 0;
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

        .signature-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-top: 50px;
        font-size: 12px;
        width: 100%;
    }

    .signature-item {
        width: 40%;
        text-align: center;
    }

    .signature-spacer {
        flex-grow: 1;
    }

    .signature-item p {
        margin: 0;

        .signature-line {
            margin-top: 60px;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="kop-surat">
        <img src="{{ $logoBase64 }}" alt="Logo ISBI Bandung">
        <div class="kop-teks">
            <h1>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h1>
            <h2>INSTITUT SENI BUDAYA INDONESIA BANDUNG</h2>
            <h2>UPA TEKNOLOGI INFORMASI DAN KOMUNIKASI</h2>
            <p class="alamat">
                Jalan Buahbatu Nomor 212 Bandung 40265<br>
                Telepon (022) 7314982, 7394532 - Faksimili (022) 7303021 Laman: <a href="https://isbi.ac.id"
                    target="_blank">isbi.ac.id</a>
            </p>
        </div>
        <hr>
    </div>

    <div class="header-title">BUKTI ACARA SERAH TERIMA</div>
    <div class="section-content">
        <p>Pada hari ini, {{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd') }}, tanggal
            {{ \Carbon\Carbon::parse($tanggal)->isoFormat('D') }} bulan
            {{ \Carbon\Carbon::parse($tanggal)->isoFormat('MMMM') }} tahun
            {{ \Carbon\Carbon::parse($tanggal)->isoFormat('Y') }} bertempat di Institut Seni Budaya Indonesia (ISBI)
            Bandung, kami yang bertanda tangan di bawah ini:</p>
        <p>
            Nama : ...................................................<br>
            NIP : ...................................................<br>
            Jabatan : ...................................................
        </p>
        <p>Yang Menerima, selanjutnya disebut <strong>Pihak Pertama</strong></p>
        <p>
            Nama : Muchamad Iqbal, S.T., M.Kom<br>
            NIP : 198112102005011002<br>
            Jabatan : Kepala UPA TIK ISBI Bandung
        </p>
        <p>Yang Menyerahkan, selanjutnya disebut <strong>Pihak Kedua</strong></p>
        <p>Pihak Kedua menyerahkan barang, dan Pihak Pertama menerima hak atas barang berupa:</p>
    </div>

    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Kode Transaksi</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksiData as $item)
                <tr>
                    <td>{{ $item->kd_transaksi }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Kalimat Penutup -->
    <p style="text-align: center; margin-top: 30px;">
        Demikian Berita Acara Serah Terima ini kami buat untuk dapat digunakan sebagaimana mestinya.
    </p>

    <!-- Signature Section -->
    <div class="signature-section">
        <!-- Pihak Kedua di sisi kiri -->
        <div class="signature-item">
            <p>Pihak Kedua,</p>
            <p style="margin-top: 60px;">Muchamad Iqbal, S.T., M.Kom</p>
            <p>NIP 198112102005011002</p>
        </div>

        <!-- Spacer untuk memastikan kedua pihak dalam satu baris -->
        <div class="signature-spacer"></div>

        <!-- Pihak Pertama di sisi kanan -->
        <div class="signature-item">
            <p>Pihak Pertama,</p>
            <p style="margin-top: 60px;">..............................................</p>
            <p>NIP ..............................................</p>
        </div>
    </div>

</body>

</html>
