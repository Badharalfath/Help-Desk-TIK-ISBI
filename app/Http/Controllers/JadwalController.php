<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Wallmount;
use App\Models\Perangkat;
use App\Models\KategoriLayanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $jadwals = Jadwal::with(['wallmount', 'perangkat', 'layanan'])->get();
        $wallmounts = Wallmount::all();
        $kategoriLayanans = KategoriLayanan::all();

        $isInput = Auth::user()->role == 'admin';

        return view('dash.jadwal', compact('jadwals', 'isInput', 'wallmounts', 'kategoriLayanans'));
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
            'kd_layanan' => 'required|exists:kategori_layanan,kd_layanan',
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
            'kd_layanan' => $request->input('kd_layanan'),
            'wallmount_id' => $request->input('wallmount_id'),
            'deskripsi' => $request->input('deskripsi'),
            'pic' => $request->input('pic'),
            'foto' => implode(',', $fotoNames),
        ]);

        return redirect()->route('jadwal')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function updateFotoKedua(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'foto_kedua.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5012', // Validasi untuk foto kedua
            'kegiatan' => 'required|string|max:255', // Validasi untuk kolom kegiatan
            'jam_selesai' => 'required', // Validasi jam_selesai
        ]);

        // Cari jadwal berdasarkan ID
        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan!');
        }

        // Proses upload foto kedua
        $fotoKeduaNames = [];
        if ($request->hasFile('foto_kedua')) {
            foreach ($request->file('foto_kedua') as $fotoKedua) {
                $originalFilename = $fotoKedua->getClientOriginalName();
                $newFilename = rand(1000000000, 9999999999) . '_' . $originalFilename;
                $fotoKedua->storeAs('public/fotos', $newFilename);
                $fotoKeduaNames[] = $newFilename;
            }

            // Update kolom foto kedua dan kegiatan
            $jadwal->update([
                'foto_kedua' => implode(',', $fotoKeduaNames),
                'kegiatan' => $request->input('kegiatan'), // Simpan kegiatan ke database
                'jam_selesai' => $request->input('jam_selesai')?? Carbon::now()->format('H:i:s'), // Simpan jam_selesai ke database
            ]);
        } else {
            // Jika tidak ada foto kedua yang diunggah, hanya update kegiatan
            $jadwal->update([
                'kegiatan' => $request->input('kegiatan'), // Simpan kegiatan ke database
            ]);
        }

        return redirect()->route('jadwal')->with('success', 'Foto kedua dan kegiatan berhasil diunggah!');
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
