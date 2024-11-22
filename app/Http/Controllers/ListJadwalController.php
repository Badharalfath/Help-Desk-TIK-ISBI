<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\KategoriProgres;
use App\Models\KategoriLayanan;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ListJadwalController extends Controller
{
    public function index(Request $request)
{
    $kategori = $request->input('kategori');
    $status = $request->input('status');
    $search = $request->input('search');

    // Update all records with null kd_progres to 'pg001'
    Jadwal::whereNull('kd_progres')->update(['kd_progres' => 'PG001']);

    // Start with a base query that includes the kategoriLayanan and kategoriProgres relationships
    $jadwals = Jadwal::with('kategoriLayanan', 'kategoriProgres');

    // Apply filter by kategori
    if ($kategori) {
        $jadwals->whereHas('kategoriLayanan', function ($query) use ($kategori) {
            $query->where('kd_layanan', $kategori);
        });
    }

    // Apply filter by status
    if ($status) {
        $jadwals->where('kd_progres', $status);
    }

    // Apply search filter
    if ($search) {
        $jadwals->where(function ($query) use ($search) {
            $query->where('id', 'like', '%' . $search . '%')
                ->orWhere('tanggal', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' . $search . '%')
                ->orWhereHas('kategoriLayanan', function ($q) use ($search) {
                    $q->where('nama_layanan', 'like', '%' . $search . '%');
                })
                ->orWhereHas('kategoriProgres', function ($q) use ($search) {
                    $q->where('nama_progres', 'like', '%' . $search . '%');
                });
        });
    }

    // Get all progress categories and available service categories
    $kategoriProgres = KategoriProgres::all();
    $kategoriLayanan = KategoriLayanan::all();

    // Paginate the results
    $jadwals = $jadwals->paginate(10);

    // Pass variables to view
    return view('dash.listjadwal', compact('jadwals', 'kategoriProgres', 'kategoriLayanan'));
}

    public function generateReport(Request $request)
    {
        $jadwalId = $request->input('jadwal_id');

        // Ambil jadwal berdasarkan ID yang dikirim
        $jadwal = Jadwal::find($jadwalId);

        if (!$jadwal) {
            return redirect()->route('maintenance')->with('error', 'Jadwal tidak ditemukan.');
        }

        // Load view untuk PDF dan kirim data yang diperlukan
        $pdf = Pdf::loadView('landing.report', compact('jadwal'));

        // Menampilkan PDF di browser
        return $pdf->stream('maintenance-report-' . $jadwal->tanggal . '.pdf'); // 'stream()' menampilkan PDF
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'kd_progres' => 'required|exists:kategori_progres,kd_progres',
        ]);

        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
        }

        $jadwal->kd_progres = $request->input('kd_progres');
        $jadwal->save();

        return redirect()->route('listjadwal')->with('success', 'Progress berhasil diubah.');
    }
}
