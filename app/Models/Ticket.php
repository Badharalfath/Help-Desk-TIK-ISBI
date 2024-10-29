<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;


    // Tambahkan kolom yang dapat diisi secara massal
    protected $fillable = [
        'email',
        'name',
        'judul',
        'keluhan',
        'kd_layanan',
        'kd_status',   // Relasi ke KategoriStatus
        'kd_progres',  // Relasi ke KategoriProgres
        'lokasi',
        'tanggal',
        'foto_keluhan',
        'status',
        'reject_reason',
    ];


    // Jika Anda ingin menetapkan atribut tanggal secara otomatis
    protected $casts = [
        'tanggal' => 'date',
    ];

    public function kategoriStatus()
    {
        return $this->belongsTo(KategoriStatus::class, 'kd_status', 'kd_status');
    }

    public function kategoriProgres()
    {
        return $this->belongsTo(KategoriProgres::class, 'kd_progres', 'kd_progres');
    }
}
