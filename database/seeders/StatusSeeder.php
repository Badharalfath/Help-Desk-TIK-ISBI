<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('status')->insert([
            ['kd_status' => 'ST001', 'nama_status' => 'pending'],
            ['kd_status' => 'ST002', 'nama_status' => 'rejected'],
            ['kd_status' => 'ST003', 'nama_status' => 'approved']
        ]);
    }
}
