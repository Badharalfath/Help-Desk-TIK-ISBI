<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 2 kategori
        Kategori::create([
            'nama_kategori' => 'Elektronik',
        ]);

        Kategori::create([
            'nama_kategori' => 'Perabotan',
        ]);
    }
}
