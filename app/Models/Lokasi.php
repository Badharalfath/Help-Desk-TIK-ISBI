<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi';
    protected $primaryKey = 'kode';
    public $incrementing = false; // Kode bukan integer

    protected $fillable = ['kode', 'nama_lokasi', 'kode_departemen'];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'kode_departemen', 'kode');
    }
}
