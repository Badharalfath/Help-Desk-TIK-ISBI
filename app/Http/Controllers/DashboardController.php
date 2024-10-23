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
            ->first(); // first() returns a single object

        // Query to get ticket counts by category
        $ticketCategories = DB::table('tickets')
            ->selectRaw('
                SUM(CASE WHEN kd_layanan = "LY001" THEN 1 ELSE 0 END) as jaringan,
                SUM(CASE WHEN kd_layanan = "LY002" THEN 1 ELSE 0 END) as aplikasi,
                SUM(CASE WHEN kd_layanan = "LY003" THEN 1 ELSE 0 END) as email
            ')
            ->first(); // first() returns a single object

        // Query to get all schedule data for the table
        $schedules = DB::table('jadwal')
            ->select('tanggal', 'kegiatan', 'kd_layanan', 'kd_progres')
            ->get(); // get() returns a collection of records

        // Query to get counts of schedules by status
        $scheduleData = DB::table('jadwal')
            ->selectRaw('
                SUM(CASE WHEN kd_progres = "PG001" THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN kd_progres = "PG002" THEN 1 ELSE 0 END) as ongoing,
                SUM(CASE WHEN kd_progres = "PG003" THEN 1 ELSE 0 END) as completed
            ')
            ->first(); // first() returns a single object

        // Pass data to the view
        return view('dash.dashboard', [
            'ticketStatuses' => $ticketStatuses,   // object with counts
            'ticketCategories' => $ticketCategories, // object with category counts
            'schedules' => $schedules, // collection of schedules
            'scheduleData' => $scheduleData  // object with schedule status counts
        ]);
    }
}
