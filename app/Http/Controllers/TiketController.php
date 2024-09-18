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

        // Ambil tiket berdasarkan kategori
        $ticketsJaringan = Ticket::where('kategori', 'Jaringan')->get();
        $ticketsAplikasi = Ticket::where('kategori', 'Aplikasi')->get();
        $ticketsEmailWebsite = Ticket::where('kategori', 'Email/Website')->get();

        // Kelompokkan tiket berdasarkan kategori
        $categories = $tickets->groupBy('kategori'); // 'kategori' adalah kolom yang digunakan untuk pengelompokan

        // Cek apakah user memiliki peran admin
        $isInput = Auth::user()->role == 'admin';

        // Kirim data tiket ke view
        return view('dash.tiket', [
            'tickets' => $tickets, 
            'ticketsJaringan' => $ticketsJaringan,
            'ticketsAplikasi' => $ticketsAplikasi,
            'ticketsEmailWebsite' => $ticketsEmailWebsite,
            'categories' => $categories, // Kirim kategori tiket
            'isInput' => $isInput
        ]);
    }

    public function generatePdf()
    {
        // Ambil semua data tiket
        $tickets = Ticket::all();

        // Kelompokkan tiket berdasarkan kategori
        $categories = $tickets->groupBy('kategori'); // Group by kategori untuk PDF

        // Load view untuk PDF dengan pengaturan landscape
        $pdf = Pdf::loadView('dash.pdfreport', ['categories' => $categories])
            ->setPaper('a4', 'landscape'); // Atur orientasi kertas menjadi landscape

        // Tampilkan PDF di browser
        return $pdf->stream('laporan_tiket.pdf'); // 'laporan_tiket.pdf' adalah nama default file yang akan didownload jika user mengklik download di browser
    }
}
