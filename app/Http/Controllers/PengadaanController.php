<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;

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
            $query->where(function($q) use ($search) {
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
}
