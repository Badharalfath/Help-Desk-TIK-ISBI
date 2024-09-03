<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Query to get ticket status counts
        $ticketStatuses = DB::table('tickets')
            ->selectRaw('
                SUM(CASE WHEN progress_status = "unresolved" THEN 1 ELSE 0 END) as unsolved,
                SUM(CASE WHEN progress_status = "ongoing" THEN 1 ELSE 0 END) as ongoing,
                SUM(CASE WHEN progress_status = "solved" THEN 1 ELSE 0 END) as solved
            ')
            ->first();

        // Pass data to the view
        return view('dash.dashboard', [
            'ticketStatuses' => $ticketStatuses
        ]);
    }
}