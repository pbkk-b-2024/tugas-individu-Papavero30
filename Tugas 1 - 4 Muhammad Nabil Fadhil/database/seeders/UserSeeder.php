<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'adminlaravel@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Bella',
                'email' => 'bella30@gmail.com',
                'password' => Hash::make('bella123'),
                'role' => 'customer',
            ]
        ];

        foreach ($users as $user) {
            $created_user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);

            $created_user->assignRole($user['role']);
        }
    }
}