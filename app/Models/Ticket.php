<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;


    // Tambahkan kolom yang dapat diisi secara massal
    protected $fillable = [
        'email',
        'name',
        'judul',
        'keluhan',
        'tanggal',
        'foto_keluhan',
        'permission_status',
        'progress_status',
        'reject_reason',
    ];

    // Jika Anda ingin menetapkan atribut tanggal secara otomatis
    protected $dates = ['tanggal'];
}
