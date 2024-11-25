<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>BERITA ACARA SERAH TERIMA</title>
    <style>
        /* General styling */
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 16px;
            margin: 20px 40px 20px 40px;
            /* Page margins disamakan */
            line-height: 1.1;
            /* Line-height disamakan */
        }

        .kop-surat {
            position: relative;
            text-align: center;
            margin-bottom: 10px;
        }

        .kop-surat img {
            position: absolute;
            top: -15px;
            left: 10px;
            width: 110px;
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
            font-size: 18px;
            font-weight: bold;
        }

        .kop-teks h2 {
            font-size: 16px;
            font-weight: bold;
        }

        .kop-teks p {
            font-size: 14px;
        }

        .kop-surat hr {
            border: 1px solid black;
            margin: 5px 0;
        }

        .header-title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0 -10px 0;
            text-transform: uppercase;
        }

        .content-section {
            margin: 8px 0 -3px;
            text-align: justify;
        }

        .info-field {
            display: flex;
            justify-content: space-between;
            margin-left: 36px;
            margin-top: 0px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            text-align: center;
            font-weight: bold;
            padding: 5px;
        }

        td {
            padding: 5px;
            text-align: left;
        }

        /* Signature styling */
        .signature-section {
            margin-top: 40px;
        }

        .signature-field {
            display: inline-block;
            width: 45%;
            text-align: left;
            font-size: 16px;
            /* Ukuran teks disamakan */
            line-height: 1.1;
            /* Line-height disamakan */
        }

        .signature-field.kepala-text {
            margin-right: 110px;
        }

        .signature-line {
            margin-top: 80px;
            text-align: left;
        }

        .signature-line-left {
            text-align: left;
            margin-left: 60px;
        }

        .signature-line2 {
            margin-top: 80px;
            text-align: left;
            margin-left: 60px;
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
        <style>
            .tab {
                display: inline-block;
                width: 40px;
                /* Lebar tab untuk efek tabulasi */
            }

            .text-center {
                text-align: center;
            }

            .bold-text {
                font-weight: bold;
                /* Membuat teks menjadi tebal */
            }

            .align-label {
                display: inline-block;
                width: 100px;
                /* Lebar label untuk menyelaraskan ":" */
            }

            .roman-label {
                display: inline-block;
                width: 40px;
                /* Jarak terbaik setelah angka Romawi */
            }
        </style>

        <p>Pada hari ini, {{ \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('dddd') }} tanggal
            {{ \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('D') }} bulan
            {{ \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('MMMM') }} tahun
            {{ \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('Y') }} bertempat di Institut Seni Budaya
            Indonesia (ISBI)
            Bandung, kami yang bertanda tangan di bawah ini:</p>

            <p>
                <span class="tab"></span><span class="roman-label">I.</span>
                <span class="align-label">Nama</span>: {{ $recipientName ?? '...................................................' }}<br>
                <span class="tab"></span><span class="tab"></span>
                <span class="align-label">NIP</span>: {{ $recipientNIP ?? '...................................................' }}<br>
                <span class="tab"></span><span class="tab"></span>
                <span class="align-label">Jabatan</span>: {{ $firstPartyPosition ?? '...................................................' }}
            </p>


        <p class="text-center">Yang Menerima, selanjutnya disebut <span class="bold-text">Pihak Pertama</span></p>

        <p>
            <span class="tab"></span><span class="roman-label">II.</span>
            <span class="align-label">Nama</span>: Muchamad Iqbal, S.T., M.Kom<br>
            <span class="tab"></span><span class="tab"></span>
            <span class="align-label">NIP</span>: 198112102005011002<br>
            <span class="tab"></span><span class="tab"></span>
            <span class="align-label">Jabatan</span>: Kepala UPA TIK ISBI Bandung
        </p>

        <p class="text-center">Yang Menyerahkan, selanjutnya disebut <span class="bold-text">Pihak Kedua</span></p>

        <p>Pihak Kedua menyerahkan barang, dan Pihak Pertama menerima hak atas barang berupa:</p>
    </div>



    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Merk</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksiData as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->merek }}</td>
                    <td>{{ $item->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="signature-section">
        <!-- Signature field untuk Pihak Kedua -->
        <div class="signature-field" style="text-align: left;">
            <p class="signature-line">Pihak Kedua</p>
            <p class="signature-line">Muchamad Iqbal, S.T., M.Kom</p>
            <p>NIP: 198112102005011002</p>
        </div>

        <!-- Signature field untuk Pihak Pertama -->
        <div class="signature-field" style="text-align: right;">
            <p class="signature-line2">Pihak Pertama</p>
            <p class="signature-line2">{{ $recipientName ?? '............................................' }}</p>
            <p class="signature-line-left">NIP: {{ $recipientNIP ?? '............................................' }}
            </p>
        </div>
    </div>




</body>

</html>
