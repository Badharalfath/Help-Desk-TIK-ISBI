@component('mail::message')
# Pemberitahuan Proses

Halo {{ $ticket->name }},

Proses pada tiket anda dengan judul "{{ $ticket->judul }}" telah dilanjutkan pada tahap "{{ $ticket->kategoriProgres->nama_progres }}".

Terimakasih,<br>
{{ config('app.name') }}
@endcomponent
