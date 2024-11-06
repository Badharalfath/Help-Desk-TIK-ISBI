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


    public function generatePDF()
    {
        $transaksi = Transaksi::join('barang', 'transaksi.kd_barang', '=', 'barang.kd_barang')
            ->select('barang.nama_barang', 'transaksi.keterangan', 'barang.jumlah')
            ->get();

        // Ambil path gambar di storage dan konversi ke base64
        $logoPath = public_path('storage/images/logoISBI.png');
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoBase64 = 'data:image/png;base64,' . $logoData;
        } else {
            $logoBase64 = null; // Jika gambar tidak ditemukan, beri nilai null
        }

        $pdf = Pdf::loadView('management.transaksiPDF', compact('transaksi', 'logoBase64'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Bukti_Serah_Terima_Aset.pdf');
    }
}
