<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeed extends Seeder
{
    public function run()
    {
        $user = [
            [
                'username' => 'admin',
                'name' => 'ini akun Admin',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'address' => 'Jl. Rusa 1, Jogjakarta',
                'phone' => '082299123456',
                'password' => bcrypt('123456'),
                'photo' => 'user-dummy-img.jpg',
            ],
            [
                'username' => 'user',
                'name' => 'ini akun User',
                'email' => 'user@example.com',
                'role' => 'pelanggan',
                'address' => 'Jl. Rusa 1, Jogjakarta',
                'phone' => '082299123445',
                'password' => bcrypt('123456'),
                'photo' => 'user-dummy-img.jpg',
            ],
            [
                'username' => 'owner',
                'name' => 'ini akun Owner',
                'email' => 'owner@example.com',
                'role' => 'owner',
                'address' => 'Jl. Rusa 1, Jogjakarta',
                'phone' => '08229912445',
                'password' => bcrypt('123456'),
                'photo' => 'user-dummy-img.jpg',
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
