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
        'kd_layanan', // Tambahkan ini untuk relasi ke kategori_layanan
        'kd_status', // Tambahkan kd_status untuk relasi ke KategoriStatus
        'lokasi',
        'tanggal',
        'foto_keluhan',
        'status',
        'progress',
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


}
