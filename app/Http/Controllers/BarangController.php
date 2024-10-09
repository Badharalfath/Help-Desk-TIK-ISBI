<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        // Mengambil semua data barang dari database
        $barang = Barang::all();

        // Mengirim data barang ke view 'management.barang'
        return view('management.barang', compact('barang'));
    }
}
