<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $primaryKey = 'kd_faq'; // Primary key diatur ke kd_faq
    public $incrementing = false; // Karena kd_faq bukan integer dan harus diisi manual

    protected $fillable = [
        'kd_faq',
        'kd_layanan',
        'pertanyaan', // Nama kolom pertanyaan di tabel `faqs`
        'penyelesaian', // Nama kolom penyelesaian di tabel `faqs`
    ];

    /**
     * Relasi ke model KategoriLayanan
     */
    public function kategoriLayanan()
    {
        return $this->belongsTo(KategoriLayanan::class, 'kd_layanan', 'kd_layanan');
    }
}
