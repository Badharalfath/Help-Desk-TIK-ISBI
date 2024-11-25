<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory;

    protected $table = 'penempatan';

    protected $primaryKey = 'kd_penempatan';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'kd_penempatan',
        'tgl_penempatan',
        'keterangan',
        'kd_barang',
        'nama_barang',
        'jumlah', // Kolom untuk menyimpan jumlah barang yang ditempatkan
        'foto_penempatan', // Kolom untuk menyimpan nama file foto
        'kd_departemen', // Tambahkan kolom ini
        'kd_lokasi' // Tambahkan kolom ini
    ];
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'kd_departemen', 'kd_departemen');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'kd_lokasi', 'kd_lokasi');
    }
}
