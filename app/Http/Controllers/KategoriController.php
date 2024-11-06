<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('barangs')->get();
        // Menampilkan kategori dan jumlah barang
        return view('management.kategori', compact('kategori'));
    }

    public function create()
    {
        // Cari kategori terakhir berdasarkan 'kd_kategori'
        $lastKategori = Kategori::orderBy('kd_kategori', 'desc')->first();

        if (!$lastKategori) {
            // Jika belum ada kategori, mulai dengan kode 'KK001'
            $kodeOtomatis = 'KK001';
        } else {
            // Ambil bagian numerik dari kode terakhir dan tambahkan 1
            $lastKode = (int) substr($lastKategori->kd_kategori, 2);
            $kodeOtomatis = 'KK' . str_pad($lastKode + 1, 3, '0', STR_PAD_LEFT);
        }

        // Kirim kode otomatis ke view
        return view('management.kategori-tambah', compact('kodeOtomatis'));
    }





    public function store(Request $request)
    {
        $request->validate([
            'kd_kategori' => 'required|unique:kategori_aset,kd_kategori',
            'nama_kategori' => 'required',
        ]);

        // Simpan ke database termasuk 'kd_kategori'
        Kategori::create([
            'kd_kategori' => $request->kd_kategori,
            'nama_kategori' => $request->nama_kategori,
            'qty_barang' => 0 // Misal di-set ke 0 untuk awal
        ]);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }



    public function edit($kode)
    {
        $kategori = Kategori::where('kd_kategori', $kode)->firstOrFail();
        return view('management.kategori-edit', compact('kategori'));
    }

    public function update(Request $request, $kode)
    {
        $kategori = Kategori::where('kd_kategori', $kode)->firstOrFail();
        $kategori->update($request->only(['nama_kategori']));

        return redirect()->route('kategori')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($kode)
    {
        $kategori = Kategori::where('kd_kategori', $kode)->firstOrFail();
        $kategori->delete();

        return redirect()->route('kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}
