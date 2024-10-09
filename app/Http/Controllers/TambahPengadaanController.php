<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengadaan;
use App\Models\Barang;
use App\Models\Kategori;

class TambahPengadaanController extends Controller
{
    // Menampilkan form pengadaan
    public function index()
    {
        // Ambil data kategori untuk dropdown
        $kategori = Kategori::all();

        // Buat nomor pengadaan (contoh implementasi)
        $no_pengadaan = 'PND-' . str_pad(Pengadaan::count() + 1, 5, '0', STR_PAD_LEFT);

        // Ambil kode barang terakhir
        $lastBarang = Barang::orderBy('kd_barang', 'desc')->first();
        $last_kd_barang = $lastBarang ? intval(substr($lastBarang->kd_barang, 1)) : 0;

        return view('management.pengadaan-tambah', compact('kategori', 'no_pengadaan', 'last_kd_barang'));
    }

    // Generate kode barang otomatis
    private function generateKodeBarang($lastKodeBarang)
    {
        if ($lastKodeBarang) {
            // Ambil angka dari kode terakhir dan tambahkan 1
            $number = (int)substr($lastKodeBarang, 1); // Hilangkan huruf B
            $nextNumber = str_pad($number + 1, 3, '0', STR_PAD_LEFT); // Tambah 1 dan format
            return 'B' . $nextNumber; // B000, B001, dst.
        }

        return 'B001'; // Default jika belum ada data
    }

    // Proses penyimpanan data pengadaan dan barang
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tgl_pengadaan' => 'required|date',
            'supplier' => 'required|string|max:255',
            'nota' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'harga_unit.*' => 'required|numeric',  // Menggunakan notasi array
            'nama_barang.*' => 'required|string',
            'kategori.*' => 'required|exists:kategori,kd_kategori',
            'jumlah.*' => 'required|integer|min:1',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // Simpan file nota jika ada
        $notaPath = $request->file('nota') ? $request->file('nota')->store('nota') : null;

        // Hitung total biaya
        $totalBiaya = array_sum(array_map(function ($harga, $jumlah) {
            return $harga * $jumlah;
        }, $request->harga_unit, $request->jumlah));

        // Simpan data pengadaan ke tabel pengadaan
        $pengadaan = Pengadaan::create([
            'tgl_pengadaan' => $request->tgl_pengadaan,
            'supplier' => $request->supplier,
            'keterangan' => $request->keterangan,
            'nota' => $notaPath,
            'harga_unit' => $request->harga_unit[0],  // Ambil harga_unit pertama sebagai angka decimal
            'total_biaya' => $totalBiaya,  // Pastikan total_biaya dimasukkan
        ]);


        // Ambil kode barang terakhir untuk generate kode barang berikutnya
        $lastKodeBarang = Barang::orderBy('kd_barang', 'desc')->first();
        $nextKodeBarang = $this->generateKodeBarang($lastKodeBarang ? $lastKodeBarang->kd_barang : null);

        // Simpan data barang ke tabel barang
        foreach ($request->nama_barang as $index => $nama_barang) {
            $fotoPath = isset($request->file('foto')[$index]) ? $request->file('foto')[$index]->store('foto_barang') : null;

            Barang::create([
                'kd_barang' => $nextKodeBarang,  // Generate kode barang
                'nama_barang' => $nama_barang,
                'merek' => $request->merek[$index],
                'kd_kategori' => $request->kategori[$index],  // ID kategori yang dipilih
                'jumlah' => $request->jumlah[$index],
                'foto' => $fotoPath,
            ]);


            // Update kode barang berikutnya untuk setiap barang
            $nextKodeBarang = $this->generateKodeBarang($nextKodeBarang);
        }

        return redirect()->route('pengadaan')->with('success', 'Pengadaan berhasil ditambahkan.');
    }
}
