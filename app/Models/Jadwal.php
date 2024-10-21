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
        'kategori',
        'wallmount_id',
        'deskripsi',
        'pic',
        'foto',
        'foto_kedua',
        'kegiatan', // Tambahkan kolom kegiatan
    ];

    public function wallmount()
    {
        return $this->belongsTo(Wallmount::class, 'wallmount_id');
    }

    public function perangkat()
    {
        return $this->belongsTo(Perangkat::class, 'perangkat_id');
    }

}
