<?php

// app/Models/Wallmount.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallmount extends Model
{
    use HasFactory;

    protected $table = 'wallmount';

    protected $fillable = ['id_wallmount', 'nama', 'lokasi', 'foto'];

    public function perangkat()
    {
        return $this->hasMany(Perangkat::class, 'id_wallmount');
    }
}
