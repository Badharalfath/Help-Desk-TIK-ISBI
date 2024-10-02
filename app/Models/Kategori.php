<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori'; // Pastikan nama tabel sesuai dengan migrasi
    
    protected $fillable = ['nama_kategori', 'qty_barang'];

    // Relasi ke model Barang
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kd_kategori');
    }
}
