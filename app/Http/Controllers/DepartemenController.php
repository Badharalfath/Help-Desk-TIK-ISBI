<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departemen;

class DepartemenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Jika ada pencarian
        if ($search) {
            $departemen = Departemen::where('nama_departemen', 'LIKE', "%$search%")->get();
        } else {
            $departemen = Departemen::all();
        }

        return view('management.departemen', compact('departemen'));
    }

    public function create()
    {
        $lastDepartemen = Departemen::orderBy('kode', 'desc')->first();
        if (!$lastDepartemen) {
            $kodeOtomatis = 'D001';
        } else {
            $lastKode = (int) substr($lastDepartemen->kode, 1);
            $kodeOtomatis = 'D' . str_pad($lastKode + 1, 3, '0', STR_PAD_LEFT);
        }

        return view('management.departemen-tambah', compact('kodeOtomatis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required',
            'keterangan' => 'nullable',
        ]);

        $departemen = new Departemen();
        $departemen->kode = $request->input('kode');
        $departemen->nama_departemen = $request->input('nama_departemen');
        $departemen->keterangan = $request->input('keterangan');
        $departemen->save();

        return redirect()->route('departemen')->with('success', 'Departemen berhasil ditambahkan!');
    }

    public function edit($kode)
    {
        $departemen = Departemen::where('kode', $kode)->firstOrFail();
        return view('management.departemen-edit', compact('departemen'));
    }

    public function update(Request $request, $kode)
    {
        $departemen = Departemen::where('kode', $kode)->firstOrFail();
        $departemen->update($request->only(['nama_departemen', 'keterangan']));
        return redirect()->route('departemen')->with('success', 'Departemen berhasil diperbarui!');
    }

    public function destroy($kode)
    {
        $departemen = Departemen::where('kode', $kode)->firstOrFail();
        $departemen->delete();
        return redirect()->route('departemen')->with('success', 'Departemen berhasil dihapus!');
    }

}
