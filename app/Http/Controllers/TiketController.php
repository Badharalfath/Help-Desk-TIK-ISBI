<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\KategoriLayanan;
use App\Models\KategoriStatus;
use App\Models\KategoriProgres;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class TiketController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve filter and search inputs
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');   // Now used as kd_layanan
        $status = $request->input('status');       // Now used as kd_status
        $progress = $request->input('progress');   // Now used as kd_progres
        $search = $request->input('search');

        // Initialize the ticket query with eager loading
        $query = Ticket::with(['kategoriLayanan', 'kategoriStatus', 'kategoriProgres']);

        // Apply filters based on the request parameters

        // Filter by date
        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        // Filter by kategori (kd_layanan)
        if ($kategori) {
            $query->where('kd_layanan', $kategori);
        }

        // Filter by status (kd_status)
        if ($status) {
            $query->where('kd_status', $status);
        }

        // Filter by progress (kd_progres)
        if ($progress) {
            $query->where('kd_progres', $progress);
        }

        // Apply search filter across relevant fields (judul, name, status, email, etc.)
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhereHas('kategoriLayanan', function ($q) use ($search) {
                        $q->where('nama_layanan', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('kategoriStatus', function ($q) use ($search) {
                        $q->where('nama_status', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('kategoriProgres', function ($q) use ($search) {
                        $q->where('nama_progres', 'like', '%' . $search . '%');
                    });
            });
        }

        // Paginate the filtered query results
        $tickets = $query->paginate(10);

        // Retrieve filter options for dropdowns
        $kategoriLayanan = KategoriLayanan::all();
        $kategoriStatus = KategoriStatus::all();
        $kategoriProgres = KategoriProgres::all();

        // Check if the user has an admin role for the `isInput` variable
        $isInput = Auth::user()->role == 'admin';

        // Return the view with all necessary data
        return view('dash.tiket', [
            'tickets' => $tickets,
            'isInput' => $isInput,
            'filters' => $request->all(),  // Preserve filter inputs in the form
            'kategoriLayanan' => $kategoriLayanan,
            'kategoriStatus' => $kategoriStatus,
            'kategoriProgres' => $kategoriProgres,
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
