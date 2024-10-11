<?php

namespace App\Http\Controllers;

use App\Models\Barang; // Ensure you import the Barang model
use App\Models\Departemen;
use App\Models\Lokasi;
use App\Models\Penempatan;
use Illuminate\Http\Request;

class PenempatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Jika ada pencarian
        if ($search) {
            $penempatan = Penempatan::where('nama_barang', 'LIKE', "%$search%")
                ->orWhere('kd_barang', 'LIKE', "%$search%") // Mencari juga berdasarkan kode barang
                ->get();
        } else {
            $penempatan = Penempatan::all();
        }

        return view('management.penempatan', compact('penempatan'));
    }


    // PenempatanController.php
    public function create()
    {
        $barang = Barang::all(); // Mengambil semua data barang
        $departemen = Departemen::all(); // Mengambil semua data departemen
        $lokasi = Lokasi::all(); // Mengambil semua data lokasi
        // Mengambil nomor penempatan terakhir
        $lastPenempatan = Penempatan::orderBy('kd_penempatan', 'desc')->first();

        // Mengambil nomor berikutnya
        if ($lastPenempatan) {
            $lastNumber = intval(substr($lastPenempatan->kd_penempatan, 2));
            $newNumber = $lastNumber + 1;
            $newKdPenempatan = 'PN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $newKdPenempatan = 'PN001';
        }

        // Mengambil data barang untuk dropdown
        $barang = Barang::all();

        return view('management.penempatan-tambah', compact('newKdPenempatan', 'barang', 'lokasi', 'departemen'));
    }


    // PenempatanController.php
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'kd_penempatan' => 'required',
            'tgl_penempatan' => 'required|date',
            'kd_barang' => 'required',
            'keterangan' => 'required',
        ]);

        // Ambil data barang berdasarkan kd_barang
        $barang = Barang::where('kd_barang', $request->kd_barang)->first();

        // Simpan data ke tabel penempatan
        Penempatan::create([
            'kd_penempatan' => $request->kd_penempatan,
            'tgl_penempatan' => $request->tgl_penempatan,
            'kd_barang' => $request->kd_barang,
            'nama_barang' => $barang->nama_barang,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('penempatan')->with('success', 'Penempatan berhasil ditambahkan');
    }

    public function getLokasi($departemenId)
    {
        $lokasi = Lokasi::where('kode_departemen', $departemenId)->get();

        return response()->json($lokasi);
    }

    public function edit($kd_penempatan)
    {
        $penempatan = Penempatan::findOrFail($kd_penempatan);
        return view('penempatan.edit', compact('penempatan'));
    }

    public function update(Request $request, $kd_penempatan)
    {
        $request->validate([
            'kd_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'tgl_penempatan' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $penempatan = Penempatan::findOrFail($kd_penempatan);
        $penempatan->update($request->all());

        return redirect()->route('penempatan')->with('success', 'Penempatan berhasil diperbarui.');
    }

    public function destroy($kd_penempatan)
    {
        $penempatan = Penempatan::findOrFail($kd_penempatan);
        $penempatan->delete();

        return redirect()->route('penempatan')->with('success', 'Penempatan berhasil dihapus.');
    }
}
