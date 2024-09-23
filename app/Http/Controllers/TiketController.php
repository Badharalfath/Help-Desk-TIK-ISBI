<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class TiketController extends Controller
{
    public function index(Request $request)
{
    // Ambil data dari filter jika ada
    $tanggal = $request->input('tanggal');
    $kategori = $request->input('kategori');
    $permission_status = $request->input('permission_status');
    $progress_status = $request->input('progress_status');

    // Query tiket dengan kondisi filter, atau ambil semua data jika tidak ada filter
    $query = Ticket::query();

    if ($tanggal) {
        $query->whereDate('tanggal', $tanggal);
    }

    if ($kategori) {
        $query->where('kategori', $kategori);
    }

    if ($permission_status) {
        $query->where('permission_status', $permission_status);
    }

    if ($progress_status) {
        $query->where('progress_status', $progress_status);
    }

    // Jika tidak ada filter yang diterapkan, ambil semua tiket
    $tickets = $query->get();

    // Cek apakah user memiliki peran admin
    $isInput = Auth::user()->role == 'admin';

    // Kirim data tiket ke view
    return view('dash.tiket', [
        'tickets' => $tickets,
        'isInput' => $isInput,
        'filters' => $request->all(), // Mengirimkan data filter agar form tetap terisi
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
