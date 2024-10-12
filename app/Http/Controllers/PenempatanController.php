<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Departemen;
use App\Models\Lokasi;
use App\Models\Penempatan;
use Illuminate\Http\Request;

class PenempatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Menggunakan query builder dengan paginate(10)
        $penempatan = Penempatan::when($search, function ($query, $search) {
            return $query->where('kd_barang', 'like', '%' . $search . '%')
                         ->orWhere('nama_barang', 'like', '%' . $search . '%');
        })->paginate(10); // Pagination dengan 10 item per halaman

        return view('management.penempatan', compact('penempatan'));
    }

    public function create()
    {
        $barang = Barang::all();
        $departemen = Departemen::all();
        $lokasi = Lokasi::all();

        // Generate kode penempatan baru
        $lastPenempatan = Penempatan::orderBy('kd_penempatan', 'desc')->first();
        if ($lastPenempatan) {
            $lastNumber = intval(substr($lastPenempatan->kd_penempatan, 2));
            $newNumber = $lastNumber + 1;
            $newKdPenempatan = 'PN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $newKdPenempatan = 'PN001';
        }

        return view('management.penempatan-tambah', compact('newKdPenempatan', 'barang', 'lokasi', 'departemen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_penempatan' => 'required',
            'tgl_penempatan' => 'required|date',
            'kd_barang' => 'required',
            'keterangan' => 'required',
        ]);

        $barang = Barang::where('kd_barang', $request->kd_barang)->first();

        Penempatan::create([
            'kd_penempatan' => $request->kd_penempatan,
            'tgl_penempatan' => $request->tgl_penempatan,
            'kd_barang' => $request->kd_barang,
            'nama_barang' => $barang->nama_barang,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('penempatan')->with('success', 'Penempatan berhasil ditambahkan.');
    }

    public function getLokasi($departemenId)
    {
        $lokasi = Lokasi::where('kode_departemen', $departemenId)->get();
        return response()->json($lokasi);
    }

    public function edit($kd_penempatan)
    {
        $penempatan = Penempatan::where('kd_penempatan', $kd_penempatan)->first();

        if (!$penempatan) {
            return redirect()->route('penempatan')->with('error', 'Penempatan tidak ditemukan.');
        }

        $barang = Barang::all();

        return view('management.penempatan-edit', compact('penempatan', 'barang'));
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
        $penempatan = Penempatan::where('kd_penempatan', $kd_penempatan)->first();

        if ($penempatan) {
            $penempatan->delete();
            return redirect()->route('penempatan')->with('success', 'Penempatan berhasil dihapus.');
        }

        return redirect()->route('penempatan')->with('error', 'Penempatan tidak ditemukan.');
    }
}
