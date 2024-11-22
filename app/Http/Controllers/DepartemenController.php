<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departemen;

class DepartemenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Filter berdasarkan pencarian jika ada
        if ($search) {
            $departemen = Departemen::where('nama_departemen', 'LIKE', "%$search%")->get();
        } else {
            $departemen = Departemen::all();
        }

        return view('management.departemen', compact('departemen'));
    }

    public function create()
    {
        $lastDepartemen = Departemen::orderBy('kd_departemen', 'desc')->first();
        if (!$lastDepartemen) {
            $kodeOtomatis = 'D001';
        } else {
            $lastKode = (int) substr($lastDepartemen->kd_departemen, 1);
            $kodeOtomatis = 'D' . str_pad($lastKode + 1, 3, '0', STR_PAD_LEFT);
        }

        return view('management.departemen-tambah', compact('kodeOtomatis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_departemen' => 'required|unique:departemen,kd_departemen',
            'nama_departemen' => 'required',
            'keterangan' => 'nullable',
        ]);

        $departemen = new Departemen();
        $departemen->kd_departemen = $request->input('kd_departemen');
        $departemen->nama_departemen = $request->input('nama_departemen');
        $departemen->keterangan = $request->input('keterangan');
        $departemen->save();

        return redirect()->route('departemen')->with('success', 'Departemen berhasil ditambahkan!');
    }

    public function edit($kd_departemen)
    {
        $departemen = Departemen::where('kd_departemen', $kd_departemen)->firstOrFail();
        return view('management.departemen-edit', compact('departemen'));
    }

    public function update(Request $request, $kd_departemen)
    {
        $request->validate([
            'nama_departemen' => 'required',
            'keterangan' => 'nullable',
        ]);

        $departemen = Departemen::where('kd_departemen', $kd_departemen)->firstOrFail();
        $departemen->update($request->only(['nama_departemen', 'keterangan']));

        return redirect()->route('departemen')->with('success', 'Departemen berhasil diperbarui!');
    }

    public function destroy($kd_departemen)
    {
        $departemen = Departemen::where('kd_departemen', $kd_departemen)->firstOrFail();
        $departemen->delete();

        return redirect()->route('departemen')->with('success', 'Departemen berhasil dihapus!');
    }
}
