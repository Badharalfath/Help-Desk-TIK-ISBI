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
        'kategori',
        'kegiatan',
        'deskripsi',
        'pic',
        'foto',
        'foto_kedua',
    ];    
}
