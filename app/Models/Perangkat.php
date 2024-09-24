<?php

// app/Models/Perangkat.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perangkat extends Model
{
    use HasFactory;

    protected $table = 'perangkat';

    protected $fillable = ['nama_perangkat', 'id_wallmount'];

    public function wallmount()
    {
        return $this->belongsTo(Wallmount::class, 'id_wallmount');
    }
}
