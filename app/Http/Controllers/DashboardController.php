<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Query to get ticket status counts including "pending" (null)
        $ticketStatuses = DB::table('tickets')
            ->selectRaw('
                SUM(CASE WHEN progress_status = "unsolved" THEN 1 ELSE 0 END) as unsolved,
                SUM(CASE WHEN progress_status = "ongoing" THEN 1 ELSE 0 END) as ongoing,
                SUM(CASE WHEN progress_status = "solved" THEN 1 ELSE 0 END) as solved,
                SUM(CASE WHEN progress_status = "pending" THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN progress_status = "spam" THEN 1 ELSE 0 END) as spam
            ')
            ->first();

        // Query to get ticket counts by category
        $ticketCategories = DB::table('tickets')
            ->selectRaw('
                SUM(CASE WHEN kategori = "Aplikasi" THEN 1 ELSE 0 END) as aplikasi,
                SUM(CASE WHEN kategori = "Email/Website" THEN 1 ELSE 0 END) as email_website,
                SUM(CASE WHEN kategori = "Jaringan" THEN 1 ELSE 0 END) as jaringan
            ')
            ->first();

        // Query to get all schedule data (jadwal) for the table
        $schedules = DB::table('jadwal')
            ->select('tanggal', 'kegiatan', 'kategori', 'status')
            ->get();

        // Query to get counts of schedules by status (Pending, Ongoing, Completed)
        $scheduleData = DB::table('jadwal')
            ->selectRaw('
                SUM(CASE WHEN status = "Pending" THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = "Ongoing" THEN 1 ELSE 0 END) as ongoing,
                SUM(CASE WHEN status = "Completed" THEN 1 ELSE 0 END) as completed
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
