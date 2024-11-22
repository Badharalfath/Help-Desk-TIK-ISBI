<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemen';

    protected $primaryKey = 'kd_departemen';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['kd_departemen', 'nama_departemen', 'keterangan'];
}
