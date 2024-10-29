<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\KategoriProgres; // Model untuk kategori_layanan
use App\Models\KategoriStatus; // Model untuk kategori_status
use Illuminate\Support\Facades\Mail;


class EditTiketController extends Controller
{

    public function index()
    {
        // Ambil semua tiket untuk ditampilkan di halaman edit
        $tickets = Ticket::all();

        // Kembalikan view dengan data tiket
        return view('dash.edittiket', compact('tickets'));
    }

    public function edit($id)
    {
        // Temukan tiket berdasarkan ID
        $ticket = Ticket::findOrFail($id);

        // Ambil semua kategori status dan progress dari tabel terkait
        $kategoriStatus = KategoriStatus::all();
        $kategoriProgres = KategoriProgres::all();

        return view('dash.edittiket', [
            'ticket' => $ticket,
            'kategoriStatus' => $kategoriStatus,
            'kategoriProgres' => $kategoriProgres,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'keluhan' => 'required|string',
            'kd_status' => 'required|exists:kategori_status,kd_status',
            'kd_progres' => 'required|exists:kategori_progres,kd_progres', // Pastikan validasi ini ada
            'reject_reason' => 'nullable|string|max:255',
        ]);

        // Temukan tiket berdasarkan ID
        $ticket = Ticket::findOrFail($id);
        $oldProgress = $ticket->kd_progres;

        // Update data berdasarkan input
        $ticket->update([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'judul' => $request->input('judul'),
            'keluhan' => $request->input('keluhan'),
            'kd_status' => $request->input('kd_status'),
            'kd_progres' => $request->input('kd_progres'), // Pastikan nilai ini tersimpan
            'reject_reason' => $request->input('reject_reason'),
        ]);

        // Kirim email notifikasi jika kd_progres berubah
        if ($oldProgress !== $request->input('kd_progres')) {
            // Panggil fungsi kirim email
            $this->sendProgressUpdateEmail($ticket);
        }

        return redirect()->route('tiket')->with('success', 'Ticket updated successfully!');
    }

    // Fungsi untuk mengirim email notifikasi perubahan progres
    protected function sendProgressUpdateEmail($ticket)
    {
        Mail::to($ticket->email)->send(new \App\Mail\ProgressUpdated($ticket));
    }


    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('tiket')->with('success', 'Ticket deleted successfully');
    }
}
