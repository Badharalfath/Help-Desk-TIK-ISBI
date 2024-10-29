@component('mail::message')
# Progress Update

Dear {{ $ticket->name }},

The progress of your ticket titled "{{ $ticket->judul }}" has been updated to "{{ $ticket->kategoriProgres->nama_progres }}".

Thanks,<br>
{{ config('app.name') }}
@endcomponent
