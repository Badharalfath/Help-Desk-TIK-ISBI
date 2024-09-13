<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FormFAQController extends Controller
{
    public function index()
    {
        // Mengembalikan view formfaq.blade.php (form untuk menambahkan FAQ)
        return view('dash.formfaq');
    }
    
    public function show($id)
    {
        // Ambil data FAQ berdasarkan ID
        $faq = Faq::findOrFail($id);
    
        // Kembalikan data dalam bentuk JSON untuk keperluan AJAX
        return response()->json($faq);
    }
    
    public function menu()
    {
        // Mengambil data FAQ berdasarkan bidang permasalahan
        $itFaqs = Faq::where('bidang_permasalahan', 'it')->get();
        $appsFaqs = Faq::where('bidang_permasalahan', 'apps')->get();

        // Mengembalikan view daftarfaq.blade.php dengan data FAQ
        return view('dash.daftarfaq', compact('itFaqs', 'appsFaqs'));
    }

    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'bidang_permasalahan' => 'required',
            'nama_masalah' => 'required',
            'deskripsi_penyelesaian_masalah' => 'required',
        ]);

        // Menyimpan data ke tabel faqs
        Faq::create([
            'bidang_permasalahan' => $request->bidang_permasalahan,
            'nama_masalah' => $request->nama_masalah,
            'deskripsi_penyelesaian_masalah' => $request->deskripsi_penyelesaian_masalah,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'FAQ berhasil ditambahkan.');
    }
}

