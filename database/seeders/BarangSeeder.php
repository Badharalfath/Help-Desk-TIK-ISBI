<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 10 data barang, 5 di kategori 'Elektronik', 5 di kategori 'Perabotan'
        Barang::create([
            'kd_barang' => 'B001',
            'nama_barang' => 'Komputer Lenovo',
            'merek' => 'Lenovo',
            'kd_kategori' => 1, // Kategori Elektronik
            'jumlah' => 10,
            'foto' => 'komputer-lenovo.jpg',
        ]);

        Barang::create([
            'kd_barang' => 'B002',
            'nama_barang' => 'Televisi Samsung',
            'merek' => 'Samsung',
            'kd_kategori' => 1, // Kategori Elektronik
            'jumlah' => 15,
            'foto' => 'tv-samsung.jpg',
        ]);

        Barang::create([
            'kd_barang' => 'B003',
            'nama_barang' => 'Smartphone Xiaomi',
            'merek' => 'Xiaomi',
            'kd_kategori' => 1, // Kategori Elektronik
            'jumlah' => 20,
            'foto' => 'smartphone-xiaomi.jpg',
        ]);

        Barang::create([
            'kd_barang' => 'B004',
            'nama_barang' => 'Kulkas LG',
            'merek' => 'LG',
            'kd_kategori' => 1, // Kategori Elektronik
            'jumlah' => 5,
            'foto' => 'kulkas-lg.jpg',
        ]);

        Barang::create([
            'kd_barang' => 'B005',
            'nama_barang' => 'Laptop Asus',
            'merek' => 'Asus',
            'kd_kategori' => 1, // Kategori Elektronik
            'jumlah' => 8,
            'foto' => 'laptop-asus.jpg',
        ]);

        // Barang kategori Perabotan
        Barang::create([
            'kd_barang' => 'B006',
            'nama_barang' => 'Meja Kayu',
            'merek' => 'Kayu Jati',
            'kd_kategori' => 2, // Kategori Perabotan
            'jumlah' => 12,
            'foto' => 'meja-kayu.jpg',
        ]);

        Barang::create([
            'kd_barang' => 'B007',
            'nama_barang' => 'Kursi Plastik',
            'merek' => 'Plastik Ku',
            'kd_kategori' => 2, // Kategori Perabotan
            'jumlah' => 25,
            'foto' => 'kursi-plastik.jpg',
        ]);

        Barang::create([
            'kd_barang' => 'B008',
            'nama_barang' => 'Lemari Pakaian',
            'merek' => 'Wardrobe Pro',
            'kd_kategori' => 2, // Kategori Perabotan
            'jumlah' => 7,
            'foto' => 'lemari-pakaian.jpg',
        ]);

        Barang::create([
            'kd_barang' => 'B009',
            'nama_barang' => 'Sofa Minimalis',
            'merek' => 'Comfort Sofa',
            'kd_kategori' => 2, // Kategori Perabotan
            'jumlah' => 3,
            'foto' => 'sofa-minimalis.jpg',
        ]);

        Barang::create([
            'kd_barang' => 'B010',
            'nama_barang' => 'Rak Buku',
            'merek' => 'BookShelf',
            'kd_kategori' => 2, // Kategori Perabotan
            'jumlah' => 18,
            'foto' => 'rak-buku.jpg',
        ]);
    }
}
