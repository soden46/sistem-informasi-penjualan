<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeed extends Seeder
{
    public function run()
    {
        $user = [
            [
                'username' => 'Admin',
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'no_telepon' => '081818181',
                'alamat' => 'Jl. Rusa 1, Jogjakarta',
                'role' => 'admin',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456'),
            ],
            [
                'username' => 'user',
                'nama' => 'ini akun User',
                'email' => 'user@gmail.com',
                'no_telepon' => '081818181',
                'alamat' => 'Jl. Rusa 1, Jogjakarta',
                'role' => 'pelanggan',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
