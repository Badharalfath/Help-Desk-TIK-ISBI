<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory;

    protected $table = 'penempatan';

    protected $primaryKey = 'kd_penempatan'; // Ensure this is set as the primary key

    public $incrementing = false; // Ensure no auto-incrementing

    protected $keyType = 'string'; // Since 'kd_penempatan' is not an integer

    protected $fillable = ['kd_penempatan', 'tgl_penempatan', 'keterangan', 'kd_barang', 'nama_barang'];
}
