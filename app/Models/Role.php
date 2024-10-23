<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['kd_role', 'role'];

    // Menambahkan logika otomatis untuk format kd_role
    public static function boot()
    {
        parent::boot();

        // Saat data baru dibuat
        static::creating(function ($model) {
            // Ambil record terakhir berdasarkan kd_role
            $latestRole = Role::latest('kd_role')->first();

            // Jika ada record sebelumnya, ambil nomor terakhir, jika tidak mulai dari 1
            $number = $latestRole ? intval(substr($latestRole->kd_role, 1)) + 1 : 1;

            // Generate kd_role dalam format R001, R002, dst.
            $model->kd_role = 'R' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
}
