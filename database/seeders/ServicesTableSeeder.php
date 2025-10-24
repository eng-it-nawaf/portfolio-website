<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service; // تصحيح اسم الموديل

class ServicesTableSeeder extends Seeder // تصحيح اسم الكلاس
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Full-Stack Web Development',
                'slug' => 'full-stack-web-development', // إضافة slug
                'description' => 'Creating modern, scalable web applications using Laravel and Next.js.',
                'content' => '<p>Integrated solutions for web development from frontend to backend...</p>',
                'icon' => 'fas fa-code',
                'features' => json_encode([
                    'تطبيقات ويب سريعة',
                    'واجهات مستخدم تفاعلية',
                    'أنظمة إدارة محتوى مخصصة',
                    'حماية وأمان متقدم'
                ]),
                'process' => json_encode([
                    'دراسة المشروع',
                    'تصميم النظام',
                    'تطوير الواجهة الأمامية',
                    'برمجة الخلفية',
                    'اختبارات الأمان'
                ]),
                'is_featured' => true,
                'is_active' => true, // إضافة الحالة النشطة
                'order' => 5
            ],
            [
                'title' => 'Frontend Development',
                'slug' => 'frontend-development', // إضافة slug
                'description' => 'Designing intuitive and responsive user interfaces.',
                'content' => '<p>Designing and developing user interfaces that combine aesthetics and performance...</p>',
                'icon' => 'fas fa-paint-brush',
                'features' => json_encode([
                    'تصميم متجاوب لجميع الشاشات',
                    'تحسين تجربة المستخدم',
                    'أداء عالي وسرعة تحميل',
                    'توافق مع متصفحات مختلفة'
                ]),
                'process' => json_encode([
                    'تحليل الجمهور المستهدف',
                    'إنشاء النماذج الأولية',
                    'تصميم الواجهات',
                    'تحسين تجربة المستخدم',
                    'اختبار التوافق'
                ]),
                'is_featured' => false,
                'is_active' => true, // إضافة الحالة النشطة
                'order' => 6
            ],
            [
                'title' => 'Mobile App Development',
                'slug' => 'mobile-app-development', // إضافة slug
                'description' => 'Building cross-platform mobile apps with Flutter.',
                'content' => '<p>We provide integrated solutions for mobile app development with the highest quality standards...</p>',
                'icon' => 'fas fa-mobile-alt',
                'features' => json_encode([
                    'تطبيقات تعمل على iOS و Android',
                    'واجهة مستخدم مميزة',
                    'أداء عالي وسريع',
                    'دعم فني متكامل'
                ]),
                'process' => json_encode([
                    'تحليل المتطلبات',
                    'تصميم الواجهات',
                    'التطوير والبرمجة',
                    'اختبار الجودة',
                    'النشر والتوزيع'
                ]),
                'is_featured' => true,
                'is_active' => true, // إضافة الحالة النشطة
                'order' => 4
            ],
        ];

        // حفظ البيانات في قاعدة البيانات
        foreach ($services as $service) {
            Service::create($service);
        }
    }
}