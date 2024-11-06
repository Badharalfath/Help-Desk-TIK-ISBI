
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Penempatan Barang - {{ $recipientName }}</title>
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

        /* Signature section styling */
        .signature-section {
            position: absolute;
            bottom: 20px;
            right: 20px;
            text-align: center;
            font-size: 12px;
        }

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

    <div class="header-title">Bukti Serah Terima Aset</div>

    <table>
        <thead>
            <tr>
                <th>No. Penggunaan</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Tanggal Penggunaan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penempatan as $p)
                <tr>
                    <td>{{ $p->kd_penempatan }}</td>
                    <td>{{ $p->kd_barang }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->tgl_penempatan }}</td>
                    <td>{{ $p->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

   <!-- Signature Section -->
<div class="signature-section">
    <!-- Automatically display location and current date in Indonesian format -->
    <div style="font-size: 14px;">
    <p>Bandung, {{ indonesianDate(date('Y-m-d')) }}</p> <!-- Displays "Bandung, current date in Indonesian" -->
    </div>

    <div class="signature-line" style="text-align: left; font-size: 14px;">
        <p style="margin: 0;">{{ $recipientName ?? '..............................................' }}</p> <!-- Display recipient name or dotted line -->

        <hr style="border: 1px solid black; margin: 2px 0;"> <!-- Adjusted margin for minimal spacing -->

        <p style="margin: 0;">Penerima</p> <!-- Label under the dotted line -->
    </div>
</div>

<!-- Blade directive for helper function -->
@php
function indonesianDate($date) {
    $months = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    $formattedDate = date('d F Y', strtotime($date));
    $month = date('F', strtotime($date));

    return str_replace($month, $months[$month], $formattedDate);
}
@endphp




</body>

</html>
