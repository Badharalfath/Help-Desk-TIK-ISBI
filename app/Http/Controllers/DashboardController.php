<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Query to get ticket status counts
        $ticketStatuses = DB::table('tickets')
            ->selectRaw('
                SUM(CASE WHEN kd_progres = "PG001" THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN kd_progres = "PG002" THEN 1 ELSE 0 END) as ongoing,
                SUM(CASE WHEN kd_progres = "PG003" THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN kd_status = "ST002" THEN 1 ELSE 0 END) as rejected,
                SUM(CASE WHEN kd_status = "ST001" THEN 1 ELSE 0 END) as spam
            ')
            ->first();

        // Query to get ticket counts by category
        $ticketCategories = DB::table('tickets')
            ->selectRaw('
                SUM(CASE WHEN kd_layanan = "LY001" THEN 1 ELSE 0 END) as jaringan,
                SUM(CASE WHEN kd_layanan = "LY002" THEN 1 ELSE 0 END) as aplikasi,
                SUM(CASE WHEN kd_layanan = "LY003" THEN 1 ELSE 0 END) as email
            ')
            ->first();

        // Query to get all schedule data for the table with kategori_layanan and kategori_progres joins
        $schedules = DB::table('jadwal')
            ->join('kategori_layanan', 'jadwal.kd_layanan', '=', 'kategori_layanan.kd_layanan')
            ->join('kategori_progres', 'jadwal.kd_progres', '=', 'kategori_progres.kd_progres')
            ->select(
                'jadwal.tanggal',
                'jadwal.kegiatan',
                'kategori_layanan.nama_layanan as kategori',
                'kategori_progres.nama_progres as status'
            )
            ->get();

        // Query to get counts of schedules by status
        $scheduleData = DB::table('jadwal')
            ->selectRaw('
                SUM(CASE WHEN kd_progres = "PG001" THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN kd_progres = "PG002" THEN 1 ELSE 0 END) as ongoing,
                SUM(CASE WHEN kd_progres = "PG003" THEN 1 ELSE 0 END) as completed
            ')
            ->first();

        // Pass data to the view
        return view('dash.dashboard', [
            'ticketStatuses' => $ticketStatuses,
            'ticketCategories' => $ticketCategories,
            'schedules' => $schedules,
            'scheduleData' => $scheduleData
        ]);
    }
}
