<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Penempatan.php
class Penempatan extends Model
{
    protected $table = 'penempatan';

    protected $fillable = [
        'kd_penempatan',
        'tgl_penempatan',
        'kd_barang',
        'nama_barang',
        'keterangan',
    ];
}

