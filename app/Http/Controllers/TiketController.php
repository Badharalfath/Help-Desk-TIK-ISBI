<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
         // Ambil semua tiket dari database
         $tickets = Ticket::all();

         // Kirim data tiket ke view
         return view('dash.tiket', ['tickets' => $tickets]);
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('dash.edit_tiket', compact('ticket')); // Buat view edit_tiket.blade.php
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully');
    }
}
