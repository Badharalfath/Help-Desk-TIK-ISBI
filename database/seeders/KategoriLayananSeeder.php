<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori_layanan')->insert([
            [
                'kd_layanan' => 'LY001',
                'nama_layanan' => 'Jaringan/Internet',
            ],
            [
                'kd_layanan' => 'LY002',
                'nama_layanan' => 'Aplikasi',
            ],
            [
                'kd_layanan' => 'LY003',
                'nama_layanan' => 'Email',
            ],
            [
                'kd_layanan' => 'LY004',
                'nama_layanan' => 'Wallmount',
            ],
        ]);
    }
}
