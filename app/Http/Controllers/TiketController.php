<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class TiketController extends Controller
{
    public function index()
    {
         // Ambil semua tiket dari database
         $tickets = Ticket::all();

         // Kirim data tiket ke view
         return view('dash.tiket', ['tickets' => $tickets]);
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update();
        return view('dash.edittiket', compact('ticket')); // Buat view edittiket.blade.php
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully');
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
