<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // Tentukan nama tabel secara eksplisit
    protected $table = 'barang'; // Pastikan ini sesuai dengan tabel yang dibuat di migrasi

    // Daftar kolom yang bisa diisi (fillable)
    protected $fillable = ['kd_barang', 'nama_barang', 'merek', 'kd_kategori', 'jumlah', 'foto'];

    // Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kd_kategori');
    }
}
