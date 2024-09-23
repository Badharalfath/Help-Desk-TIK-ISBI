<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FormFAQController extends Controller
{
    // Menampilkan form untuk menambahkan FAQ
    public function index()
    {
        return view('dash.formfaq');
    }

    // Menampilkan detail FAQ berdasarkan ID (untuk keperluan AJAX)
    public function show($id)
    {
        $faq = Faq::findOrFail($id);
        return response()->json($faq);
    }

    // Menampilkan FAQ berdasarkan kategori 'it' dan 'apps'
    public function menu()
    {
        $itFaqs = Faq::where('bidang_permasalahan', 'it')->get();
        $appsFaqs = Faq::where('bidang_permasalahan', 'apps')->get();

        return view('dash.daftarfaq', compact('itFaqs', 'appsFaqs'));
    }

    // Menyimpan FAQ baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'bidang_permasalahan' => 'required|string|max:255',
            'nama_masalah' => 'required|string|max:255',
            'deskripsi_penyelesaian_masalah' => 'required|string',
        ]);

        // Simpan data FAQ ke database
        Faq::create([
            'bidang_permasalahan' => $request->bidang_permasalahan,
            'nama_masalah' => $request->nama_masalah,
            'deskripsi_penyelesaian_masalah' => $request->deskripsi_penyelesaian_masalah,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('faq.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit FAQ yang sudah ada
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('dash.editfaq', compact('faq'));
    }

    // Memproses update data FAQ
    public function update(Request $request, $id)
    {
        // Validasi input form
        $request->validate([
            'bidang_permasalahan' => 'required|string|max:255',
            'nama_masalah' => 'required|string|max:255',
            'deskripsi_penyelesaian_masalah' => 'required|string',
        ]);

        // Cari FAQ yang akan diupdate
        $faq = Faq::findOrFail($id);

        // Update data FAQ
        $faq->update([
            'bidang_permasalahan' => $request->bidang_permasalahan,
            'nama_masalah' => $request->nama_masalah,
            'deskripsi_penyelesaian_masalah' => $request->deskripsi_penyelesaian_masalah,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('faq.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    // Menghapus FAQ
    public function destroy($id)
    {
        // Cari FAQ yang akan dihapus
        $faq = Faq::findOrFail($id);

        // Hapus FAQ dari database
        $faq->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('faq.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
