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
                'name' => 'Rafly',
                'email' => 'rafly2027@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('123456')
            ]

        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
