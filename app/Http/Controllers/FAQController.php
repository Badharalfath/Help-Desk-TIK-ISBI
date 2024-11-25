<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Ambil FAQ sesuai pencarian (jika ada) dan exclude kategori 'Wallmount'
        $faqsByCategory = Faq::with('kategoriLayanan')
            ->whereHas('kategoriLayanan', function ($query) {
                $query->where('nama_layanan', '!=', 'Wallmount');
            })
            ->when($search, function ($query) use ($search) {
                $query->where('pertanyaan', 'like', '%' . $search . '%');
            })
            ->get()
            ->groupBy('kd_layanan');

        return view('landing.faq', [
            'faqsByCategory' => $faqsByCategory,
            'search' => $search,
        ]);
    }
}
