<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class TiketController extends Controller
{
    public function index()
    {
         // Ambil semua tiket dari database
         $tickets = Ticket::all();

         $isInput = Auth::user()->role == 'admin';
         // Kirim data tiket ke view
         return view('dash.tiket', ['tickets' => $tickets, 'isInput'=> $isInput]);
    }

    public function generatePdf()
    {
        // Ambil semua data tiket
        $tickets = Ticket::all();

        // Load view untuk PDF dengan pengaturan landscape
        $pdf = Pdf::loadView('dash.pdfreport', ['tickets' => $tickets])
                  ->setPaper('a4', 'landscape'); // Atur orientasi kertas menjadi landscape

        // Download file PDF
        return $pdf->download('laporan_tiket.pdf');
    }

}
