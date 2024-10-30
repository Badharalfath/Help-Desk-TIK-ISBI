<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\KategoriLayanan;

class FormFAQController extends Controller
{
    // Menampilkan form untuk menambahkan FAQ
    public function index()
    {
        $kdLayananOptions = KategoriLayanan::select('kd_layanan', 'nama_layanan')->get();
        return view('dash.formfaq', compact('kdLayananOptions'));
    }

    // Menampilkan detail FAQ berdasarkan ID (untuk keperluan AJAX)
    public function show($id)
    {
        $faq = Faq::with('kategoriLayanan')->findOrFail($id);
        return response()->json([
            'kd_faq' => $faq->kd_faq,
            'nama_layanan' => $faq->kategoriLayanan->nama_layanan ?? null,
            'pertanyaan' => $faq->pertanyaan,
            'penyelesaian' => $faq->penyelesaian,
        ]);
    }

    // Menampilkan FAQ berdasarkan kategori
    public function menu(Request $request)
    {
        $categories = Faq::select('kd_layanan')->distinct()->get();
        $search = $request->input('search');

        // Memuat data relasi dengan kategori layanan
        $allFaqs = Faq::with('kategoriLayanan')->when($search, function ($query, $search) {
            return $query->where('pertanyaan', 'like', '%' . $search . '%');
        })->get();

        return view('dash.daftarfaq', compact('allFaqs', 'categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kd_layanan' => 'required|string|max:10',
            'pertanyaan' => 'required|string|max:255',
            'penyelesaian' => 'required|string',
        ]);

        $lastFaq = Faq::orderBy('kd_faq', 'desc')->first();
        if ($lastFaq) {
            $lastNumber = intval(substr($lastFaq->kd_faq, 2));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }
        $newKdFaq = 'FA' . $newNumber;

        Faq::create([
            'kd_faq' => $newKdFaq,
            'kd_layanan' => $request->kd_layanan,
            'pertanyaan' => $request->pertanyaan,
            'penyelesaian' => $request->penyelesaian,
        ]);

        return redirect()->route('faq.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit FAQ yang sudah ada
    public function edit($kd_faq)
    {
        $faq = Faq::where('kd_faq', $kd_faq)->firstOrFail();

        // Ambil opsi layanan dari database untuk digunakan dalam select dropdown
        $layananOptions = KategoriLayanan::select('kd_layanan', 'nama_layanan')->get();

        return view('dash.editfaq', compact('faq', 'layananOptions'));
    }
    // Memproses update data FAQ
    public function update(Request $request, $id)
    {
        $request->validate([
            'kd_layanan' => 'required|exists:kategori_layanan,kd_layanan',
            'pertanyaan' => 'required|string|max:255',
            'penyelesaian' => 'required|string',
        ]);

        $faq = Faq::findOrFail($id);

        $faq->update([
            'kd_layanan' => $request->kd_layanan,
            'pertanyaan' => $request->pertanyaan,
            'penyelesaian' => $request->penyelesaian,
        ]);

        return redirect()->route('faq.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    // Menghapus FAQ
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('faq.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
