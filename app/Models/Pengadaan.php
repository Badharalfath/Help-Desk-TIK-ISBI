<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;

    protected $table = 'pengadaan';  // Nama tabel
    protected $fillable = [
        'tgl_pengadaan',
        'supplier',
        'keterangan',
        'nota',
        'harga_unit',
        'total_biaya',  // Tambahkan ini
    ];

    // Jika ada relasi ke tabel lain, bisa ditambahkan di sini
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
