<?php

// app/Http/Controllers/WallmountController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallmount;
use App\Models\Perangkat;

class WallmountController extends Controller
{
    public function index()
    {
        // Ambil semua data wallmount dari database
        $wallmounts = Wallmount::all();

        // Kirim data wallmount ke view
        return view('dash.wallmount', compact('wallmounts'));
    }

    public function create()
    {
        return view('dash.wallmount-tambah');
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

        return redirect()->route('wallmount.index')->with('success', 'Wallmount dan perangkat berhasil ditambahkan.');
    }
    public function show($id)
    {
        // Ambil wallmount berdasarkan ID dan perangkat terkaitnya
        $wallmount = Wallmount::with('perangkat')->findOrFail($id);
        return view('dash.wallmount-show', compact('wallmount'));
    }

    public function edit($id)
    {
        // Mengambil wallmount beserta perangkatnya berdasarkan ID
        $wallmount = Wallmount::with('perangkat')->findOrFail($id);
        return view('dash.wallmount-edit', compact('wallmount'));
    }

    public function destroy($id)
    {
        $wallmount = Wallmount::findOrFail($id);
        $wallmount->delete();

        return redirect()->route('wallmount.index')->with('success', 'Wallmount berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'perangkat' => 'required|array|max:4', // Maksimal 4 perangkat
            'perangkat.*' => 'nullable|string|max:255',
        ]);

        // Update data wallmount
        $wallmount = Wallmount::findOrFail($id);
        $wallmount->update([
            'nama' => $request->input('nama'),
            'lokasi' => $request->input('lokasi'),
        ]);

        // Update atau tambahkan perangkat
        foreach ($request->input('perangkat') as $index => $nama_perangkat) {
            if ($index < $wallmount->perangkat->count()) {
                $perangkat = $wallmount->perangkat[$index];

                if (!is_null($nama_perangkat) && $nama_perangkat !== '') {
                    // Update perangkat jika tidak kosong
                    $perangkat->update([
                        'nama_perangkat' => $nama_perangkat,
                    ]);
                } else {
                    // Hapus perangkat jika kosong
                    $perangkat->delete();
                }
            } else {
                // Tambahkan perangkat baru jika belum ada dan inputnya tidak kosong
                if (!is_null($nama_perangkat) && $nama_perangkat !== '') {
                    $wallmount->perangkat()->create([
                        'nama_perangkat' => $nama_perangkat,
                    ]);
                }
            }
        }

        // Redirect kembali ke halaman daftar wallmount dengan pesan sukses
        return redirect()->route('wallmount.index')->with('success', 'Wallmount dan perangkat berhasil diperbarui.');
    }



}