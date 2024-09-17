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
            'foto.*' => 'nullable|image|max:5012', // Validasi setiap file foto
            'g-recaptcha-response' => 'required|captcha',
            'lokasi' => $request->kategori === 'Jaringan' ? 'required|string|max:255' : 'nullable|string',
        ]);

        // Handle upload multiple foto keluhan
        $fotoNames = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                $originalFilename = $foto->getClientOriginalName();
                $newFilename = rand(1000000000, 9999999999) . '_' . $originalFilename;

                // Simpan file dengan nama baru di folder 'storage/app/public/fotos'
                $foto->storeAs('public/fotos', $newFilename);

                // Tambahkan nama file ke array
                $fotoNames[] = $newFilename;
            }
        }

        // Gabungkan nama-nama file yang di-upload menjadi satu string dipisahkan dengan koma
        $fotoNamesString = implode(',', $fotoNames);

        // Simpan data keluhan ke database
        $complaint = Ticket::create([
            'email' => $request->email,
            'name' => $request->name,
            'judul' => $request->judul,
            'keluhan' => $request->keluhan,
            'kategori' => $request->kategori,
            'lokasi' => $request->kategori === 'Jaringan' ? $request->lokasi : null,
            'foto_keluhan' => $fotoNamesString,  // Simpan string nama-nama file foto
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
