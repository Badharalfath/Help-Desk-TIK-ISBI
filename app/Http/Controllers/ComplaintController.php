<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Http;

class ComplaintController extends Controller
{
    public function showForm()
    {
        return view('landing.complaint');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'keluhan' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        // Simpan data keluhan ke database
        Ticket::create([
            'email' => $request->email,
            'name' => $request->name,
            'judul' => $request->judul,
            'keluhan' => $request->keluhan,
            'tanggal' => now(), // Menambahkan tanggal otomatis
        ]);

        return redirect()->route('complaint')->with('success', 'Your complaint has been submitted successfully!');
    }
}
