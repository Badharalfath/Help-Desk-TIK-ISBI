<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'bidang_permasalahan',
        'nama_masalah',
        'deskripsi_penyelesaian_masalah',
    ];
}
