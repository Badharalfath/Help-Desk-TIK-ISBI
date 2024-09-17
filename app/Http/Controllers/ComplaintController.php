<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComplaintSubmitted;
use App\Models\User;

class ComplaintController extends Controller
{
    public function showForm()
    {
        return view('landing.complaint');
    }

    public function submitForm(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'keluhan' => 'required|string',
            'kategori' => 'required|string',
            'foto_keluhan' => 'nullable|image|max:5012',
            'g-recaptcha-response' => 'required|captcha',
            'lokasi' => $request->kategori === 'Jaringan' ? 'required|string|max:255' : 'nullable|string', // Validasi lokasi jika kategori adalah Jaringan
        ]);

        // Handle upload foto keluhan
        $fotoName = null;
        if ($request->hasFile('foto')) {
            $originalFilename = $request->file('foto')->getClientOriginalName();
            $newFilename = rand(1000000000, 9999999999) . '_' . $originalFilename;

            // Simpan file dengan nama baru di folder 'storage/app/public/fotos'
            $request->file('foto')->storeAs('public/fotos', $newFilename);

            // Hanya simpan nama file
            $fotoName = $newFilename;
        }

        // Simpan data keluhan ke database
        $complaint = Ticket::create([
            'email' => $request->email,
            'name' => $request->name,
            'judul' => $request->judul,
            'keluhan' => $request->keluhan,
            'kategori' => $request->kategori,
            'lokasi' => $request->kategori === 'Jaringan' ? $request->lokasi : null, // Simpan lokasi jika kategori Jaringan
            'foto_keluhan' => $fotoName,
            'tanggal' => now(),
            'permission_status' => 'pending',
            'progress_status' => 'pending',
        ]);

        // Kirim email notifikasi ke admin
        $emailAdmin = User::where('role', 'admin')->first();
        $emailAdmins = User::where('role', 'admin')->whereNot('email', $emailAdmin->email)->get()->pluck('email')->toArray();

        Mail::to($emailAdmin)->cc($emailAdmins)->send(new ComplaintSubmitted($complaint));

        return redirect()->route('complaint')->with('success', 'Your complaint has been submitted successfully!');
    }



}
