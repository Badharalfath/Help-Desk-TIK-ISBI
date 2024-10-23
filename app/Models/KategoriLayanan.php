<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLayanan extends Model
{
    use HasFactory;

    protected $table = 'kategori_layanan';
    protected $primaryKey = 'kd_layanan';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kd_layanan', 'nama_layanan'];

    // Penomoran otomatis untuk kd_layanan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Ambil id terbesar lalu tambahkan 1
            $maxId = static::max('id');
            $model->kd_layanan = 'LY' . str_pad($maxId + 1, 3, '0', STR_PAD_LEFT);
        });
    }

    public function kategoriLayanan()
    {
        return $this->belongsTo(KategoriLayanan::class, 'kd_layanan', 'kd_layanan');
    }

}
