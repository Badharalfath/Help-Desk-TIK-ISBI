<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter bulan atau gunakan bulan sekarang jika tidak ada
        $currentMonthYear = $request->input('month') ?: date('Y-m');

        // Ambil jadwal berdasarkan bulan yang diminta
        $jadwals = Jadwal::whereYear('tanggal', '=', Carbon::parse($currentMonthYear)->year)
            ->whereMonth('tanggal', '=', Carbon::parse($currentMonthYear)->month)
            ->get();

        return view('dash.jadwal', compact('jadwals', 'currentMonthYear'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_berakhir' => 'required|date_format:H:i|after:jam_mulai',
            'kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:5012',
        ]);

        // Proses upload foto jika ada
        $fotoName = null;
        if ($request->hasFile('foto')) {
            // Dapatkan nama file asli
            $originalFilename = $request->file('foto')->getClientOriginalName();

            // Buat nama file baru dengan 10 angka acak di depan dan underscore
            $newFilename = rand(1000000000, 9999999999) . '_' . $originalFilename;

            // Simpan file dengan nama baru
            $request->file('foto')->storeAs('public/fotos', $newFilename);

            // Hanya simpan nama file
            $fotoName = $newFilename;
        }

        // Simpan data jadwal
        Jadwal::create([
            'tanggal' => $request->input('tanggal'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_berakhir' => $request->input('jam_berakhir'),
            'kegiatan' => $request->input('kegiatan'),
            'deskripsi' => $request->input('deskripsi'),
            'foto' => $fotoName, // Simpan hanya nama file, bukan path lengkap
        ]);

        return redirect()->route('jadwal')->with('success', 'Jadwal berhasil ditambahkan.');
    }

}