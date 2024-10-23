<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori_aset';
    public $incrementing = false;
    protected $primaryKey = 'kd_kategori'; // Atur primary key sesuai kolom yang benar
    protected $fillable = ['kd_kategori', 'nama_kategori', 'qty_barang'];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kd_kategori', 'kd_kategori');
    }
}

