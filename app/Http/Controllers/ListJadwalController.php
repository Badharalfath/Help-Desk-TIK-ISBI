<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ListJadwalController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->input('kategori');
        $status = $request->input('status');
        $search = $request->input('search');

        // Ambil jadwal dari database sesuai dengan bulan dan tahun yang ditentukan
        $jadwals = Jadwal::query();

        // Apply filter kategori jika ada
        if ($kategori) {
            $jadwals->where('kategori', $kategori);
        }

        // Apply filter status jika ada
        if ($status) {
            $jadwals->where('status', $status);
        }

        // Apply search filter jika ada
        if ($search) {
            $jadwals->where(function ($query) use ($search) {
                $query->where('id', 'like', '%' . $search . '%')
                    ->orWhere('tanggal', 'like', '%' . $search . '%')
                    ->orWhere('kategori', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
    }


        $jadwals = $jadwals->paginate(10);

        // Kirim variabel ke view
        return view('dash.listjadwal', compact('jadwals'));
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
            'status' => 'required|in:Pending,Ongoing,Completed',
        ]);

        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
        }

        $jadwal->status = $request->input('status');
        $jadwal->save();

        return redirect()->route('listjadwal')->with('success', 'Status berhasil diubah.');
    }
}
