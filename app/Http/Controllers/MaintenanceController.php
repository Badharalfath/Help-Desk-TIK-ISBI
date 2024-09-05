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
        $month = $request->input('month');

        // Jika tidak ada bulan yang diterima, gunakan bulan dan tahun saat ini
        if (!$month) {
            $currentMonthYear = Carbon::now()->format('Y-m');
        } else {
            $currentMonthYear = $month;
        }

        // Ambil jadwal dari database sesuai dengan bulan dan tahun yang ditentukan
        $jadwals = Jadwal::whereYear('tanggal', '=', Carbon::parse($currentMonthYear)->year)
            ->whereMonth('tanggal', '=', Carbon::parse($currentMonthYear)->month)
            ->get();

        // Kirim variabel ke view
        return view('landing.maintenance', compact('currentMonthYear', 'jadwals'));
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
