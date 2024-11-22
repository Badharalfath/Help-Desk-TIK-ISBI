<?php

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
        $lastLokasi = Lokasi::orderBy('kd_lokasi', 'desc')->first();
        $kodeOtomatis = $lastLokasi ? 'L' . str_pad((int) substr($lastLokasi->kd_lokasi, 1) + 1, 3, '0', STR_PAD_LEFT) : 'L001';

        return view('management.lokasi-tambah', compact('departemen', 'kodeOtomatis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_lokasi' => 'required|unique:lokasi,kd_lokasi',
            'nama_lokasi' => 'required',
            'kd_departemen' => 'required|exists:departemen,kd_departemen',
        ]);

        Lokasi::create($request->all());

        return redirect()->route('lokasi')->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function edit($kd_lokasi)
    {
        $lokasi = Lokasi::where('kd_lokasi', $kd_lokasi)->firstOrFail();
        $departemen = Departemen::all();
        return view('management.lokasi-edit', compact('lokasi', 'departemen'));
    }

    public function update(Request $request, $kd_lokasi)
    {
        $request->validate([
            'nama_lokasi' => 'required',
            'kd_departemen' => 'required|exists:departemen,kd_departemen',
        ]);

        $lokasi = Lokasi::where('kd_lokasi', $kd_lokasi)->firstOrFail();
        $lokasi->update($request->only(['nama_lokasi', 'kd_departemen']));

        return redirect()->route('lokasi')->with('success', 'Lokasi berhasil diperbarui!');
    }


    public function destroy($kd_lokasi)
    {
        $lokasi = Lokasi::where('kd_lokasi', $kd_lokasi)->firstOrFail();
        $lokasi->delete();
        return redirect()->route('lokasi')->with('success', 'Lokasi berhasil dihapus!');
    }
}
