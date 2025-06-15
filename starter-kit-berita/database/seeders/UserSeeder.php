<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // <-- Import model User
use Illuminate\Support\Facades\Hash; // <-- Import Hash

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat User dengan level Admin
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Cari berdasarkan email
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // Password default: password
                'level' => 'admin',
                'email_verified_at' => now(), // Langsung verifikasi email
            ]
        );

        // Membuat User dengan level Editor
        User::firstOrCreate(
            ['email' => 'editor@gmail.com'], // Cari berdasarkan email
            [
                'name' => 'Editor User',
                'password' => Hash::make('password'), // Password default: password
                'level' => 'editor',
                'email_verified_at' => now(),
            ]
        );
        
        // Membuat User dengan level Wartawan
        User::firstOrCreate(
            ['email' => 'wartawan@gmail.com'], // Cari berdasarkan email
            [
                'name' => 'Wartawan User',
                'password' => Hash::make('password'), // Password default: password
                'level' => 'wartawan',
                'email_verified_at' => now(),
            ]
        );
    }
}