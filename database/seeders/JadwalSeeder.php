<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        // Generate 20 data dummy
        Jadwal::factory()->count(20)->create();
    }
}
