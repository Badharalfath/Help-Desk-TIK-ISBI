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
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'keluhan' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
        ]);


         // Simpan data keluhan ke database
        $complaint = Ticket::create([
            'email' => $request->email,
            'name' => $request->name,
            'judul' => $request->judul,
            'keluhan' => $request->keluhan,
            'tanggal' => now(),
            'permission_status' => 'pending',
        ]);

    // Kirim email notifikasi
    $emailAdmin=User::where('role', 'admin')->first();
    $emailAdmins=User::where('role', 'admin')->whereNot('email',$emailAdmin->email)->get()->pluck('email')->toArray();

    Mail::to($emailAdmin)->cc($emailAdmins)->send(new ComplaintSubmitted($complaint));

        return redirect()->route('complaint')->with('success', 'Your complaint has been submitted successfully!');
    }
}
