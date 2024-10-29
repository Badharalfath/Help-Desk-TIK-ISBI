<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Status Tiket</title>
</head>
<body>
    <h1>Status Tiket Anda</h1>
    <p>Halo {{ $ticket->name }},</p>
    <p>Tiket Anda dengan judul "{{ $ticket->judul }}" telah berhasil dibuat. Status saat ini adalah: {{ $ticket->status_name }}.</p>
    <p>Kami akan email baru jika tiket anda diterima.</p>
</body>
</html>
