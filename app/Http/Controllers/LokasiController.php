<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Departemen;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Jika ada pencarian
        if ($search) {
            $lokasi = Lokasi::where('nama_lokasi', 'LIKE', "%$search%")
                ->orWhereHas('departemen', function ($query) use ($search) {
                    $query->where('nama_departemen', 'LIKE', "%$search%");
                })->get();
        } else {
            $lokasi = Lokasi::with('departemen')->get();
        }

        return view('management.lokasi', compact('lokasi'));
    }

    public function create()
    {
        $departemen = Departemen::all();
        $lastLokasi = Lokasi::orderBy('kode', 'desc')->first();
        $kodeOtomatis = $lastLokasi ? 'L' . str_pad((int) substr($lastLokasi->kode, 1) + 1, 3, '0', STR_PAD_LEFT) : 'L001';

        return view('management.lokasi-tambah', compact('departemen', 'kodeOtomatis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:lokasi,kode',
            'nama_lokasi' => 'required',
            'kode_departemen' => 'required|exists:departemen,kode',
        ]);

        Lokasi::create($request->all());

        return redirect()->route('lokasi')->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function edit($kode)
    {
        $lokasi = Lokasi::where('kode', $kode)->firstOrFail();
        $departemen = Departemen::all();
        return view('management.lokasi-edit', compact('lokasi', 'departemen'));
    }

    public function update(Request $request, $kode)
    {
        $lokasi = Lokasi::where('kode', $kode)->firstOrFail();
        $lokasi->update($request->only(['nama_lokasi', 'kode_departemen']));

        return redirect()->route('lokasi')->with('success', 'Lokasi berhasil diperbarui!');
    }

    public function destroy($kode)
    {
        $lokasi = Lokasi::where('kode', $kode)->firstOrFail();
        $lokasi->delete();
        return redirect()->route('lokasi')->with('success', 'Lokasi berhasil dihapus!');
    }
}
