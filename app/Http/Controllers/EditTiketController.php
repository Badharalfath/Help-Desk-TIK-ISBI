<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;


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

    // Kirim data tiket ke view 'dash.edittiket'
    return view('dash.edittiket', compact('ticket'));
    }

    public function update(Request $request, $id)
    {

        // Validasi data
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'keluhan' => 'required|string',
            'status' => 'required|string|in:approved,rejected',
            'status' => 'nullable|string|in:unsolved,ongoing,solved',
            'reject_reason' => 'nullable|string|max:255',
        ]);

        // Temukan tiket berdasarkan ID
        $ticket = Ticket::findOrFail($id);

        // Update tiket
        $ticket->email = $request->input('email');
        $ticket->name = $request->input('name');
        $ticket->judul = $request->input('judul');
        $ticket->keluhan = $request->input('keluhan');
        $ticket->keluhan = $request->input('keluhan');
        $ticket->status = $request->input('status');
        $ticket->status = $request->input('status');
        $ticket->reject_reason = $request->input('reject_reason');

        // Jika status adalah rejected, status di-set otomatis ke 'spam'
        if ($ticket->status === 'rejected') {
            $ticket->status = 'spam';
        } else {
            // Jika status bukan rejected, status mengikuti input user
            $ticket->status = $request->input('status');
        }

        $ticket->save();

        // Redirect dengan pesan sukses
        return redirect()->route('tiket')->with('success', 'Ticket updated successfully!');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('tiket')->with('success', 'Ticket deleted successfully');
    }

}

