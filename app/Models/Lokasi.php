<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi';
    protected $primaryKey = 'kd_lokasi';
    public $incrementing = false; // Kode bukan integer

    protected $fillable = ['kd_lokasi', 'nama_lokasi', 'kd_departemen'];

    public function departemen()
{
    return $this->belongsTo(Departemen::class, 'kd_departemen', 'kd_departemen');
}

}
