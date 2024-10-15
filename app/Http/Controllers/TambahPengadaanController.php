<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\Kategori;

class TambahPengadaanController extends Controller
{
    // Menampilkan form transaksi
    public function index()
    {
        // Ambil data kategori untuk dropdown
        $kategori = Kategori::all();

        // Buat nomor transaksi (contoh implementasi)
        $no_transaksi = 'TS' . str_pad(Transaksi::count() + 1, 4, '0', STR_PAD_LEFT);

        // Ambil kode barang terakhir
        $lastBarang = Barang::orderBy('kd_barang', 'desc')->first();
        $last_kd_barang = $lastBarang ? intval(substr($lastBarang->kd_barang, 1)) : 0;

        return view('management.pengadaan-tambah', compact('kategori', 'no_transaksi', 'last_kd_barang'));
    }

    // Generate kode barang otomatis
    private function generateKodeBarang($lastKodeBarang)
    {
        if ($lastKodeBarang) {
            $number = (int)substr($lastKodeBarang, 1);
            $nextNumber = str_pad($number + 1, 3, '0', STR_PAD_LEFT);
            return 'B' . $nextNumber;
        }
        return 'B001';
    }

    // Proses penyimpanan data transaksi dan barang
    public function store(Request $request)
    {
        // Validasi input sesuai kebutuhan transaksi
        $request->validate([
            'tgl_transaksi' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'nota' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'nama_barang.*' => 'required|string',
            'kategori.*' => 'required|exists:kategori,kd_kategori',
            'jumlah.*' => 'required|integer|min:1',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // Simpan file nota jika ada
        $notaPath = $request->file('nota') ? $request->file('nota')->store('nota') : null;

        // Generate kode transaksi otomatis
        $lastTransaksi = Transaksi::orderBy('kd_transaksi', 'desc')->first();
        $nextKodeTransaksi = 'TS' . str_pad(($lastTransaksi ? intval(substr($lastTransaksi->kd_transaksi, 2)) + 1 : 1), 4, '0', STR_PAD_LEFT);

        // Ambil kode barang terakhir untuk generate kode barang berikutnya
        $lastKodeBarang = Barang::orderBy('kd_barang', 'desc')->first();
        $nextKodeBarang = $this->generateKodeBarang($lastKodeBarang ? $lastKodeBarang->kd_barang : null);

        // Simpan data barang ke tabel barang
        foreach ($request->nama_barang as $index => $nama_barang) {
            $fotoPath = isset($request->file('foto')[$index]) ? $request->file('foto')[$index]->store('foto_barang') : null;

            // Simpan barang
            $barang = Barang::create([
                'kd_barang' => $nextKodeBarang,
                'nama_barang' => $nama_barang,
                'merek' => $request->merek[$index],
                'kd_kategori' => $request->kategori[$index],
                'jumlah' => $request->jumlah[$index],
                'foto' => $fotoPath,
            ]);

            // Jika ini adalah barang pertama, gunakan kd_barang untuk transaksi
            if ($index == 0) {
                $firstKdBarang = $nextKodeBarang;
            }

            // Update kode barang berikutnya untuk item selanjutnya
            $nextKodeBarang = $this->generateKodeBarang($nextKodeBarang);
        }

        // Simpan transaksi ke tabel transaksi dengan kd_barang pertama
        $transaksi = Transaksi::create([
            'kd_transaksi' => $nextKodeTransaksi,
            'tgl_transaksi' => $request->tgl_transaksi,
            'keterangan' => $request->keterangan,
            'nota' => $notaPath,
            'kd_barang' => $firstKdBarang,  // Simpan kode barang pertama di transaksi
        ]);

        return redirect()->route('pengadaan')->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
