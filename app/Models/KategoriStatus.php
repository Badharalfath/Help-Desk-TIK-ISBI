<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriStatus extends Model
{
    use HasFactory;

    protected $table = 'kategori_status';
    protected $fillable = ['kd_status', 'nama_status'];
    public $timestamps = true;

    // Penomoran otomatis untuk kd_status
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Ambil id terbesar lalu tambahkan 1
            $maxId = static::max('id');
            $model->kd_status = 'ST' . str_pad($maxId + 1, 3, '0', STR_PAD_LEFT);
        });
    }
}
