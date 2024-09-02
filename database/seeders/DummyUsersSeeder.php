<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin ISBI',
                'email' => 'admin@example.org',
                'role' => 'admin',
                'password' => Hash::make('123456')
            ],

            [
                'name' => 'Kepala ISBI',
                'email' => 'kepala@example.org',
                'role' => 'kepala',
                'password' => Hash::make('123456')
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}