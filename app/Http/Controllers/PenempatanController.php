<?php

namespace App\Http\Controllers;

use App\Models\Barang; // Ensure you import the Barang model
use App\Models\Penempatan;
use Illuminate\Http\Request;

class PenempatanController extends Controller
{
    public function index()
    {
        // Logic to display penempatan data
        return view('management.penempatan'); // Return view for listing penempatan
    }

    // PenempatanController.php
    public function create()
    {
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

        return view('management.penempatan-tambah', compact('newKdPenempatan', 'barang'));
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

}
