<?php

namespace App\Observers;

use App\Models\Ticket;
use App\Models\KategoriStatus;
use App\Mail\TicketStatusNotification;
use Illuminate\Support\Facades\Mail;

class TicketObserver
{
    public function updated(Ticket $ticket)
    {
        // Check if the status has changed
        if ($ticket->isDirty('kd_status')) {
            // Retrieve the updated status name from the kategori_status table
            $status = KategoriStatus::where('kd_status', $ticket->kd_status)->first();
            $ticket->status_name = $status->nama_status ?? 'Unknown';

            // Send email to user with updated status
            Mail::to($ticket->email)->send(new TicketStatusNotification($ticket));
        }
    }
}
