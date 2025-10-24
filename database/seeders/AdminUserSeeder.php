<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            User::create([
        'name' => 'nawaf',
        'email' => 'nawaf@gmail.com',
        'password' => Hash::make('password123'), // غير كلمة السر
    ]);
    }
}
