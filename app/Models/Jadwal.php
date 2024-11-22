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

    /**
     * Set nilai default untuk kd_progres saat saving.
     */
    protected static function booted()
    {
        static::saving(function ($jadwal) {
            if (is_null($jadwal->kd_progres)) {
                $jadwal->kd_progres = 'pg001'; // Default ke 'Pending'
            }
        });
    }

    /**
     * Relasi ke tabel wallmount.
     */
    public function wallmount()
    {
        return $this->belongsTo(Wallmount::class, 'wallmount_id');
    }

    /**
     * Relasi ke tabel perangkat.
     */
    public function perangkat()
    {
        return $this->belongsTo(Perangkat::class, 'perangkat_id');
    }

    /**
     * Relasi ke tabel kategori_layanan.
     */
    public function layanan()
    {
        return $this->belongsTo(KategoriLayanan::class, 'kd_layanan', 'kd_layanan');
    }

    /**
     * Relasi ke tabel kategori_progres.
     */
    public function progres()
    {
        return $this->belongsTo(KategoriProgres::class, 'kd_progres', 'kd_progres');
    }

    /**
     * Alias untuk relasi ke kategori_layanan.
     */
    public function kategoriLayanan()
    {
        return $this->belongsTo(KategoriLayanan::class, 'kd_layanan', 'kd_layanan');
    }

    /**
     * Alias untuk relasi ke kategori_progres.
     */
    public function kategoriProgres()
    {
        return $this->belongsTo(KategoriProgres::class, 'kd_progres', 'kd_progres');
    }
}
