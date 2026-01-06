<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'نواف المغبشي',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $this->command->info('✅ تم إنشاء المستخدم الإداري بنجاح');
        $this->command->info('📧 البريد: admin@example.com');
        $this->command->info('🔑 كلمة المرور: password');
    }
}