<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;

class PengadaanController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan input pencarian dari request
        $search = $request->input('search');

        // Query untuk mendapatkan data transaksi bersama dengan nama barang
        $query = Transaksi::join('barang', 'transaksi.kd_barang', '=', 'barang.kd_barang')
            ->select('transaksi.*', 'barang.nama_barang');

        // Jika ada pencarian, tambahkan kondisi pencarian pada query
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('transaksi.kd_transaksi', 'like', "%{$search}%")
                    ->orWhere('transaksi.keterangan', 'like', "%{$search}%")
                    ->orWhere('barang.nama_barang', 'like', "%{$search}%");
            });
        }

        // Eksekusi query untuk mendapatkan data transaksi
        $transaksi = $query->get();

        // Mengirim data transaksi dan pencarian ke view
        return view('management.pengadaan', compact('transaksi', 'search'));
    }

    // Fungsi untuk menghapus transaksi
    public function destroy($kd_transaksi)
    {
        // Cari transaksi berdasarkan kd_transaksi
        $transaksi = Transaksi::findOrFail($kd_transaksi);

        // Hapus data transaksi tersebut
        $transaksi->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('pengadaan')->with('Sukses', 'Data Transaksi berhasil dihapus.');
    }


    public function generatePDF(Request $request)
    {
        // Retrieve inputs
        $recipientName = $request->input('recipient_name');
        $recipientNIP = $request->input('recipient_nip');
        $firstPartyPosition = $request->input('first_party_position');
        $selectedTransaksi = $request->input('transaksi', []);

        // Validate selected transactions
        if (empty($selectedTransaksi)) {
            return redirect()->route('pengadaan')->withErrors(['error' => 'Silakan pilih transaksi yang ingin dimasukkan ke dalam PDF.']);
        }

        // Fetch selected transaction data
        $transaksiData = Transaksi::join('barang', 'transaksi.kd_barang', '=', 'barang.kd_barang')
            ->whereIn('transaksi.kd_transaksi', $selectedTransaksi)
            ->select('transaksi.kd_transaksi', 'barang.nama_barang', 'barang.merek', 'barang.jumlah', 'transaksi.keterangan')
            ->get();

        // Fetch logo
        $logoPath = public_path('storage/images/logoISBI.png');
        $logoBase64 = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : null;

        // Determine template based on input
        $isInputEmpty = empty($recipientName) && empty($recipientNIP) && empty($firstPartyPosition);
        $template = $isInputEmpty ? 'management.transaksiPDF2' : 'management.transaksiPDF';

        // Define current date
        $tanggal = now();

        // Generate PDF
        $pdf = Pdf::loadView($template, compact(
            'transaksiData',
            'logoBase64',
            'recipientName',
            'recipientNIP',
            'firstPartyPosition',
            'tanggal'
        ))->setPaper('a4', 'portrait');

        return $pdf->stream("Bukti_Serah_Terima_Aset.pdf");
    }
}
