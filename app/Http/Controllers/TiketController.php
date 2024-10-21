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
        // Ambil data dari filter dan search jika ada
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $status = $request->input('status');
        $progress = $request->input('progress');
        $search = $request->input('search'); // Ambil input search

        // Inisialisasi query tiket
        $query = Ticket::query();

        // Filter berdasarkan tanggal
        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        // Filter berdasarkan kategori
        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        // Filter berdasarkan permission status
        if ($status) {
            $query->where('status', $status);
        }

        // Filter berdasarkan progress status
        if ($progress) {
            $query->where('progress', $progress);
        }

        // Filter berdasarkan search di kolom yang relevan (judul, name, status, progress, dan email)
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('progress', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Paginate hasil query menjadi 10 data per halaman
        $tickets = $query->paginate(10);

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
