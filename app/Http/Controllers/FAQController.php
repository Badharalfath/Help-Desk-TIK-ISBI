<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        // Ambil data FAQ dari database dan pisahkan berdasarkan kategori
        $faqsIT = Faq::where('bidang_permasalahan', 'it')->get();
        $faqsApps = Faq::where('bidang_permasalahan', 'apps')->get();

        // Kirim data ke blade view
        return view('landing.faq', [
            'faqsIT' => $faqsIT,
            'faqsApps' => $faqsApps,
        ]);
    }
}
