<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        Profile::create([
            'user_id' => $user->id,
            'name' => 'نواف المغبشي',
            'title' => 'مطور ويب ومصمم واجهات',
            'about' => 'أنا مطور ويب متخصص في بناء تطبيقات ويب حديثة باستخدام Laravel و React. لدي خبرة أكثر من 5 سنوات في تطوير حلول برمجية متكاملة للشركات والأفراد.',
            'email' => 'nawaf@example.com',
            'phone' => '+966500000000',
            'address' => 'الرياض، المملكة العربية السعودية',
            'photo' => 'profile.jpg',
            'social_links' => json_encode([
                'linkedin' => 'https://linkedin.com/in/nawaf',
                'github' => 'https://github.com/nawaf',
                'twitter' => 'https://twitter.com/nawaf',
            ]),
            'whatsapp' => '+966500000000',
            'telegram' => '@nawaf',
            'facebook' => 'https://facebook.com/nawaf',
            'youtube' => 'https://youtube.com/c/nawaf',
            'instagram' => 'https://instagram.com/nawaf',
            'stackoverflow' => 'https://stackoverflow.com/users/nawaf',
            'website' => 'https://nawaf.com',
        ]);

        $this->command->info('✅ تم إنشاء الملف الشخصي بنجاح');
    }
}