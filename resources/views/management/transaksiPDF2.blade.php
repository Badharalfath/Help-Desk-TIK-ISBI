{{-- <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bukti Serah Terima Aset</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
            margin-top: 20px;
            min-height: 100vh;
        }



        .signature-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 50px;
            font-size: 12px;
        }

        .signature-item {
            width: 40%;
            text-align: left;
        }

        .signature-item2 {
            width: 40%;
            text-align: left;
        }
    </style>
</head>

<body>



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

    <table>
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

    <p style="text-align: left; margin-top: 30px;">
        Demikian Berita Acara Serah Terima ini kami buat untuk dapat digunakan sebagaimana mestinya.
    </p>

    <!-- Signature Section -->
    <div class="signature-section">
        <div class="signature-item">
            <p>Pihak Kedua,</p>
            <p style="margin-top: 60px;">Muchamad Iqbal, S.T., M.Kom</p>
            <p>NIP 198112102005011002</p>
        </div>

        <div class="signature-item2">
            <p>Pihak Pertama,</p>
            <p style="margin-top: 60px;">..............................................</p>
            <p>NIP ..............................................</p>
        </div>
    </div>

</body>

</html> --}}

<style>
    /* General styling */
    body {
        font-family: "Times New Roman", Times, serif;
        font-size: 16px;
        margin: 20px 40px 20px 40px; /* Page margins disamakan */
        line-height: 1.1; /* Line-height disamakan */
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

    table, th, td {
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
        font-size: 16px; /* Ukuran teks disamakan */
        line-height: 1.1; /* Line-height disamakan */
    }

    .signature-field.kepala-text {
        margin-right: 110px;
    }

    .signature-line {
        margin-top: 80px;
        text-align: left;
    }

    .signature-line2 {
        margin-top: 80px;
        text-align: left;
        margin-left: 102px;
    }
</style>


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

<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:150%;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'><strong><span style='font-size:19px;line-height:150%;font-family:"Times New Roman",serif;'>BERITA ACARA SERAH TERIMA</span></strong></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-size:16px;font-family:"Times New Roman",serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><span style='font-size:16px;line-height:115%;font-family:"Times New Roman",serif;'>Pada Hari ini,&nbsp;</span><span style='font-size:16px;line-height:115%;font-family:"Times New Roman",serif;'>Kamis</span><span style='font-size:16px;line-height:115%;font-family:"Times New Roman",serif;'>&nbsp;tanggal &nbsp;</span><span style='font-size:16px;line-height:115%;font-family:"Times New Roman",serif;'>sepuluh&nbsp;</span><span style='font-size:16px;line-height:115%;font-family:"Times New Roman",serif;'>bulan&nbsp;</span><span style='font-size:16px;line-height:115%;font-family:"Times New Roman",serif;'>Oktober</span><span style='font-size:16px;line-height:115%;font-family:"Times New Roman",serif;'>&nbsp;tahun dua ribu&nbsp;</span><span style='font-size:16px;line-height:115%;font-family:"Times New Roman",serif;'>dua puluh empat&nbsp;</span><span style='font-size:16px;line-height:115%;font-family:"Times New Roman",serif;'>(10/10/2024) bertempat di Institut Seni Budaya Indonesia (ISBI) Bandung, kami yang bertanda tangan di bawah ini:</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><span style='font-size:16px;font-family:"Times New Roman",serif;'>&nbsp;</span></p>
<div style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;'>
    <ol style="margin-bottom:0cm;list-style-type: upper-roman;margin-left: 44px;">
        <li style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='line-height:150%;font-family:"Times New Roman",serif;font-size:16px;'>Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: ...................................................</span></li>
    </ol>
</div>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:54.0pt;line-height:150%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><span style='font-size:16px;line-height:150%;font-family:"Times New Roman",serif;'>NIP&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: ...................................................</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:54.0pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><span style='font-size:16px;font-family:"Times New Roman",serif;'>Jabatan&nbsp; &nbsp; &nbsp;&nbsp;: ...................................................</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:54.0pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><span style='font-size:16px;font-family:"Times New Roman",serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-size:16px;font-family:"Times New Roman",serif;'>Yang Menerima, selanjutnya disebut <strong>Pihak Pertama</strong></span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:54.0pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><span style='font-size:16px;font-family:"Times New Roman",serif;'>&nbsp;</span></p>
<div style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;'>
    <ol style="margin-bottom:0cm;">
        <li style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='line-height:150%;font-family:"Times New Roman",serif;font-size:16px;'>Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;</span><span style='line-height:150%;font-family:"Times New Roman",serif;font-size:16px;'>Muchamad Iqbal, S.T., M.Kom</span></li>
    </ol>
</div>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:54.0pt;line-height:150%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><span style='font-size:16px;line-height:150%;font-family:"Times New Roman",serif;'>NIP&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: 198112102005011002</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:108.0pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;text-indent:-54.0pt;'><span style='font-size:16px;font-family:"Times New Roman",serif;'>Jabatan&nbsp; &nbsp; &nbsp;&nbsp;:</span><span style='font-size:16px;font-family:"Times New Roman",serif;'>&nbsp;Kepala UPA TIK ISBI Bandung</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:54.0pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><span style='font-size:16px;font-family:"Times New Roman",serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;margin:0cm;text-align:center;'><span style='font-size:16px;font-family:"Times New Roman",serif;'>Yang Menyerahkan, selanjutnya disebut <strong>Pihak Kedua</strong></span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;margin:0cm;text-align:center;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>&nbsp;</span></strong></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;line-height:150%;font-size:15px;font-family:"Calibri",sans-serif;margin:0cm;text-align:justify;'><span style='font-size:16px;line-height:150%;font-family:"Times New Roman",serif;'>Pihak Kedua menyerahkan barang, dan Pihak Pertama menerima hak atas barang berupa:</span></p>

<table>
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

<div class="signature-section">
    <div class="signature-field">
        <p>Bandung, {{ indonesianDate(date('Y-m-d')) }}</p>
        <p>Peminjam</p>
        <p class="signature-line">{{ $recipientName ?? '............................................' }}</p>
        <p>NIP: {{ $recipientNip ?? '............................................' }}</p>
    </div>
    <div class="signature-field" style="text-align: right;">
        <p class="signature-line2">Kepala UPT. TIK</p>
        <p class="signature-line2">Muchamad Iqbal, ST</p>
        <p>NIP: 198112102005011002</p>
    </div>
</div>


</body>
