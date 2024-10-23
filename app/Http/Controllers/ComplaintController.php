<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComplaintSubmitted;
use App\Models\User;
use App\Models\KategoriLayanan; // Model untuk kategori_layanan
use App\Models\KategoriStatus; // Model untuk kategori_status

class ComplaintController extends Controller
{
    public function showForm()
    {
        // Ambil semua data kategori layanan
        $kategoriLayanan = KategoriLayanan::all();

        return view('landing.complaint', compact('kategoriLayanan'));
    }

    public function submitForm(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'keluhan' => 'required|string',
            'kd_layanan' => 'required|string', // Input ini akan digunakan untuk mencari kd_layanan
            'foto.*' => 'nullable|image|max:5012', // Validasi setiap file foto
            'g-recaptcha-response' => 'required|captcha',
            'lokasi' => $request->kategori_layanan === 'Jaringan' ? 'required|string|max:255' : 'nullable|string',
        ]);

        // Cari kd_layanan berdasarkan input kategori_layanan
        $layanan = KategoriLayanan::where('kd_layanan', $request->kd_layanan)->first();
        if (!$layanan) {
            return redirect()->back()->withErrors(['kategori_layanan' => 'Kategori layanan tidak ditemukan.']);
        }

        // Cari kd_status default (misalnya pending) dari tabel kategori_status
        $status = KategoriStatus::where('nama_status', 'pending')->first();
        if (!$status) {
            return redirect()->back()->withErrors(['kd_status' => 'Status default tidak ditemukan.']);
        }

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
            'kd_layanan' => $layanan->kd_layanan, // Masukkan kd_layanan dari tabel kategori_layanan
            'lokasi' => $request->kategori_layanan === 'Jaringan' ? $request->lokasi : null,
            'foto_keluhan' => $fotoNamesString,  // Simpan string nama-nama file foto
            'tanggal' => now(),
            'kd_status' => $status->kd_status, // Masukkan kd_status dari tabel kategori_status
        ]);

        // Kirim email notifikasi ke admin
        $emailAdmin = User::where('role', 'admin')->first();
        $emailAdmins = User::where('role', 'admin')->whereNot('email', $emailAdmin->email)->get()->pluck('email')->toArray();

        Mail::to($emailAdmin)->cc($emailAdmins)->send(new ComplaintSubmitted($complaint));

        return redirect()->route('complaint')->with('success', 'Your complaint has been submitted successfully!');
    }




}
