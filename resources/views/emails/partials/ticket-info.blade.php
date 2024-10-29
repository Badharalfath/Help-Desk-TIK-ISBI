@component('mail::message')
# Ticket Update

Dear {{ $ticket->name }},

We wanted to let you know that your ticket has been updated.

### Ticket Information
- **Title**: {{ $ticket->judul }}
- **Status**: {{ $ticket->kategoriStatus->status_name }}
- **Progress**: {{ $ticket->kategoriProgres->nama_progres }}

Thank you,<br>
{{ config('app.name') }}
@endcomponent
