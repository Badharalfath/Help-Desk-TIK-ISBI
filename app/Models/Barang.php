<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';  // Nama tabel
    protected $primaryKey = 'kd_barang'; // Set 'kd_barang' as the primary key
    public $incrementing = false; // Disable auto-incrementing as 'kd_barang' is a string
    protected $keyType = 'string'; // Define the primary key as a string

    protected $fillable = [
        'kd_barang',
        'nama_barang',
        'merek',
        'kd_kategori',
        'jumlah',
        'harga_unit',
        'foto',
    ];

    // Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kd_kategori', 'kd_kategori');
    }
}
