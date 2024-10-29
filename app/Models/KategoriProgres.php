<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProgres extends Model
{
    use HasFactory;

    protected $table = 'kategori_progres';
    protected $fillable = ['kd_progres', 'nama_progres'];
    public $timestamps = true;

    // Penomoran otomatis untuk kd_progres
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Ambil id terbesar lalu tambahkan 1
            $maxId = static::max('id');
            $model->kd_progres = 'PG' . str_pad($maxId + 1, 3, '0', STR_PAD_LEFT);
        });
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'kd_progres', 'kd_progres');
    }
}
