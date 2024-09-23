<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $jadwalsPaginated = Jadwal::paginate(10);
        
        $jadwals = Jadwal::all();
 
        // Kirim variabel ke view
        return view('landing.maintenance', compact( 'jadwals', 'jadwalsPaginated'));
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
}
