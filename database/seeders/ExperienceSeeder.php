<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            // خبرات عملية
            [
                'title' => 'مطور ويب رئيسي',
                'company' => 'شركة التقنية المتقدمة',
                'description' => 'قمت بتطوير وإدارة أكثر من 50 مشروع ويب باستخدام Laravel و React. أشرفت على فريق مكون من 5 مطورين.',
                'start_date' => '2022-01-01',
                'end_date' => null,
                'is_current' => true,
                'type' => 'work',
            ],
            [
                'title' => 'مطور ويب متقدم',
                'company' => 'شركة الحلول الذكية',
                'description' => 'طورت أنظمة إدارة محتوى مخصصة وتطبيقات ويب معقدة. عملت مع عملاء محليين ودوليين.',
                'start_date' => '2020-03-01',
                'end_date' => '2021-12-31',
                'is_current' => false,
                'type' => 'work',
            ],
            [
                'title' => 'مطور ويب مبتدئ',
                'company' => 'شركة ويب سوليوشنز',
                'description' => 'بدأت مسيرتي المهنية في تطوير مواقع ويب بسيطة ثم تدرجت في المشاريع المعقدة.',
                'start_date' => '2019-01-01',
                'end_date' => '2020-02-28',
                'is_current' => false,
                'type' => 'work',
            ],
            
            // تعليم
            [
                'title' => 'بكالوريوس علوم الحاسب',
                'company' => 'جامعة الملك سعود',
                'description' => 'تخصصت في هندسة البرمجيات وتطوير تطبيقات الويب. مشروع التخرج كان نظام إدارة مشاريع متكامل.',
                'start_date' => '2015-09-01',
                'end_date' => '2019-06-01',
                'is_current' => false,
                'type' => 'education',
            ],
            [
                'title' => 'دبلوم تطوير الويب',
                'company' => 'معهد التقنية',
                'description' => 'تدريب متخصص في تطوير تطبيقات الويب باستخدام PHP و JavaScript وقواعد البيانات.',
                'start_date' => '2018-01-01',
                'end_date' => '2018-12-01',
                'is_current' => false,
                'type' => 'education',
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }

        $this->command->info('✅ تم إنشاء ' . count($experiences) . ' خبرة بنجاح');
    }
}