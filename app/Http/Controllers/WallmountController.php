<?php

// app/Http/Controllers/WallmountController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallmount;
use App\Models\Perangkat;

class WallmountController extends Controller
{
    public function create()
    {
        return view('dash.wallmount');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'perangkat' => 'required|array|max:4', // Maksimal 4 perangkat
            'perangkat.*' => 'nullable|string|max:255',
        ]);

        // Buat Wallmount
        $wallmount = Wallmount::create([
            'nama' => $request->input('nama'),
            'lokasi' => $request->input('lokasi'),
        ]);

        // Simpan perangkat yang terkait, hanya jika nama perangkat tidak kosong
        foreach ($request->input('perangkat') as $nama_perangkat) {
            if (!empty($nama_perangkat)) {
                Perangkat::create([
                    'nama_perangkat' => $nama_perangkat,
                    'id_wallmount' => $wallmount->id,
                ]);
            }
        }

        return redirect()->route('wallmount.create')->with('success', 'Wallmount dan perangkat berhasil ditambahkan.');
    }
}
