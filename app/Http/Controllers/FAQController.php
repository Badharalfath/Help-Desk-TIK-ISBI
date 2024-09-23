<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        // Ambil semua data FAQ dan kelompokkan berdasarkan 'bidang_permasalahan'
        $faqsByCategory = Faq::all()->groupBy('bidang_permasalahan');

        // Kirim data yang sudah dikelompokkan ke blade view
        return view('landing.faq', [
            'faqsByCategory' => $faqsByCategory,
        ]);
    }
}
