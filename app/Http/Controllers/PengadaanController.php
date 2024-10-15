<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;

class PengadaanController extends Controller
{
    public function index()
    {
        // Mengambil data transaksi bersama dengan data barang terkait menggunakan join
        $transaksi = Transaksi::join('barang', 'transaksi.kd_barang', '=', 'barang.kd_barang')
            ->select('transaksi.*', 'barang.nama_barang')
            ->get();

        // Mengirim data transaksi dan nama barang ke view
        return view('management.pengadaan', compact('transaksi'));
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

}
