<?php

namespace Database\Factories;

use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JadwalFactory extends Factory
{
    protected $model = Jadwal::class;

    public function definition()
    {
        return [
            'tanggal' => $this->faker->date(),
            'jam_mulai' => $this->faker->time(),
            'jam_berakhir' => $this->faker->time(),
            'kegiatan' => $this->faker->sentence(3), // 3 kata random untuk kegiatan
            'deskripsi' => $this->faker->paragraph(2), // 2 paragraf random untuk deskripsi
            'pic' => $this->faker->name(), // Nama random untuk PIC
            'kategori' => $this->faker->randomElement(['Aplikasi & Website', 'Internet & Jaringan']),
            'foto' => $this->faker->imageUrl(), // URL random untuk foto
            'foto_kedua' => $this->faker->imageUrl(), // URL random untuk foto kedua
            'status' => $this->faker->randomElement(['Pending', 'Ongoing', 'Completed']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
