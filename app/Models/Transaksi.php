<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Definisikan properti yang diperlukan seperti tabel, primary key, dll.
    protected $table = 'transaksi';
    protected $primaryKey = 'kd_transaksi';
    public $incrementing = false; // Jika kode transaksi tidak auto-increment

    protected $fillable = [
        'kd_transaksi',
        'tgl_transaksi',
        'keterangan',
        'nota',
        'kd_barang',
    ];
}
