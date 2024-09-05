<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;


class EditTiketController extends Controller
{
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
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
            'permission_status' => 'required|string|in:approved,rejected',
            'progress_status' => 'nullable|string|in:unsolved,ongoing,solved',
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
        $ticket->permission_status = $request->input('permission_status');
        $ticket->progress_status = $request->input('progress_status');
        $ticket->reject_reason = $request->input('reject_reason');

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

