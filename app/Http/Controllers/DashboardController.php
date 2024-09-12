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
                SUM(CASE WHEN progress_status IS NULL THEN 1 ELSE 0 END) as pending
            ')
            ->first();

        // Query to get ticket counts by category
        $ticketCategories = DB::table('tickets')
            ->selectRaw('
                SUM(CASE WHEN kategori = "Aplikasi" THEN 1 ELSE 0 END) as aplikasi,
                SUM(CASE WHEN kategori = "Email/Website" THEN 1 ELSE 0 END) as email_website,
                SUM(CASE WHEN kategori = "Jaringan/Internet" THEN 1 ELSE 0 END) as jaringan
            ')
            ->first();

        // Pass data to the view
        return view('dash.dashboard', [
            'ticketStatuses' => $ticketStatuses,
            'ticketCategories' => $ticketCategories
        ]);
    }
}
