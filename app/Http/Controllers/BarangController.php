<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->get();
        return view('management.barang', compact('barang'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $lastBarang = Barang::orderBy('kd_barang', 'desc')->first();
        $kodeOtomatis = $lastBarang ? 'KB' . str_pad((int) substr($lastBarang->kd_barang, 2) + 1, 3, '0', STR_PAD_LEFT) : 'KB001';

        return view('management.barang-tambah', compact('kategori', 'kodeOtomatis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_barang' => 'required|unique:barang,kd_barang',
            'nama_barang' => 'required',
            'kd_kategori' => 'required|exists:kategori,kode',
        ]);

        Barang::create($request->all());

        // Update qty_barang
        $this->updateKategoriQty($request->kd_kategori);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($kd_barang)
    {
        $barang = Barang::where('kd_barang', $kd_barang)->firstOrFail();
        $kategori = Kategori::all();
        return view('management.barang-edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, $kd_barang)
    {
        $barang = Barang::where('kd_barang', $kd_barang)->firstOrFail();
        $barang->update($request->only(['nama_barang', 'kd_kategori']));

        // Update qty_barang
        $this->updateKategoriQty($barang->kd_kategori);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($kd_barang)
    {
        $barang = Barang::where('kd_barang', $kd_barang)->firstOrFail();
        $barang->delete();

        // Update qty_barang
        $this->updateKategoriQty($barang->kd_kategori);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }

    private function updateKategoriQty($kd_kategori)
    {
        $kategori = Kategori::where('kode', $kd_kategori)->firstOrFail();
        $kategori->qty_barang = Barang::where('kd_kategori', $kd_kategori)->count();
        $kategori->save();
    }
}
