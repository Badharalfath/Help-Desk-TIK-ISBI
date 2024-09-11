<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FormFAQController extends Controller
{
    public function index()
    {
        // Mengembalikan view formfaq.blade.php
        return view('dash.formfaq');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bidang_permasalahan' => 'required',
            'nama_masalah' => 'required',
            'deskripsi_penyelesaian_masalah' => 'required',
        ]);

        Faq::create([
            'bidang_permasalahan' => $request->bidang_permasalahan,
            'nama_masalah' => $request->nama_masalah,
            'deskripsi_penyelesaian_masalah' => $request->deskripsi_penyelesaian_masalah,
        ]);

        return redirect()->back()->with('success', 'FAQ berhasil ditambahkan.');
    }
}
