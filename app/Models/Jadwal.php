<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal'; // Nama tabel yang sesuai di database

    protected $fillable = [
        'tanggal',
        'jam_mulai',
        'jam_berakhir',
        'jam_selesai',
        'kd_layanan',
        'wallmount_id',
        'deskripsi',
        'pic',
        'foto',
        'foto_kedua',
        'kegiatan',
    ];

    public function wallmount()
    {
        return $this->belongsTo(Wallmount::class, 'wallmount_id');
    }

    public function perangkat()
    {
        return $this->belongsTo(Perangkat::class, 'perangkat_id');
    }

    // Relasi ke tabel kategori_layanan
    public function layanan()
    {
        return $this->belongsTo(KategoriLayanan::class, 'kd_layanan', 'kd_layanan');
    }

    public function progres()
    {
        return $this->belongsTo(KategoriProgres::class, 'kd_progres', 'kd_progres');
    }

    // In Jadwal.php model

    public function kategoriLayanan()
    {
        return $this->belongsTo(KategoriLayanan::class, 'kd_layanan', 'kd_layanan');
    }

    public function kategoriProgres()
    {
        return $this->belongsTo(KategoriProgres::class, 'kd_progres', 'kd_progres');
    }
}
