<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Wallmount;
use App\Models\Perangkat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $jadwals = Jadwal::with(['wallmount', 'perangkat'])->get();
        $wallmounts = Wallmount::all();

        $isInput = Auth::user()->role == 'admin';

        return view('dash.jadwal', compact('jadwals', 'isInput', 'wallmounts'));
    }

    public function getPerangkatByWallmount($id)
    {
        $perangkats = Perangkat::where('id_wallmount', $id)->get();
        return response()->json($perangkats);
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_berakhir' => 'required|date_format:H:i|after:jam_mulai',
            'kategori' => 'required|string',
            'wallmount_id' => 'nullable|exists:wallmount,id', // validasi jika kategori wallmount
            'deskripsi' => 'required|string',
            'pic' => 'required|string|max:255',
            'foto.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5012', // Mengubah validasi menjadi array
        ]);

        $fotoNames = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                // Dapatkan nama file asli
                $originalFilename = $foto->getClientOriginalName();

                // Buat nama file baru dengan angka acak
                $newFilename = rand(1000000000, 9999999999) . '_' . $originalFilename;

                // Simpan file dengan nama baru
                $foto->storeAs('public/fotos', $newFilename);

                // Tambahkan nama file ke array
                $fotoNames[] = $newFilename;
            }
        }

        // Simpan data jadwal
        $jadwal = Jadwal::create([
            'tanggal' => $request->input('tanggal'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_berakhir' => $request->input('jam_berakhir'),
            'kategori' => $request->input('kategori'),
            'wallmount_id' => $request->input('wallmount_id'),
            'deskripsi' => $request->input('deskripsi'),
            'pic' => $request->input('pic'),
            'foto' => implode(',', $fotoNames),
        ]);

        return redirect()->route('jadwal')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function updateFotoKedua(Request $request, $id)
    {
        $request->validate([
            'foto_kedua.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5012', // Mengubah validasi menjadi array
        ]);

        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan!');
        }

        $fotoKeduaNames = [];
        if ($request->hasFile('foto_kedua')) {
            foreach ($request->file('foto_kedua') as $fotoKedua) {
                // Dapatkan nama file asli
                $originalFilename = $fotoKedua->getClientOriginalName();

                // Buat nama file baru
                $newFilename = rand(1000000000, 9999999999) . '_' . $originalFilename;

                // Simpan file dengan nama baru
                $fotoKedua->storeAs('public/fotos', $newFilename);

                // Tambahkan nama file ke array
                $fotoKeduaNames[] = $newFilename;
            }

            // Simpan nama file sebagai string yang dipisahkan koma
            $jadwal->update(['foto_kedua' => implode(',', $fotoKeduaNames)]);
        }

        return redirect()->route('jadwal')->with('success', 'Foto kedua berhasil diunggah!');
    }


    public function editFotoKedua($id)
    {
        $jadwal = Jadwal::find($id);

        if (!$jadwal) {
            return redirect()->route('maintenance')->with('error', 'Jadwal tidak ditemukan!');
        }

        // Periksa apakah foto kedua sudah ada
        $hasFotoKedua = !is_null($jadwal->foto_kedua);

        return view('dash.edit-foto-kedua', compact('jadwal', 'hasFotoKedua'));
    }

}
