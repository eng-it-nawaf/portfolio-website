<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'نظام إدارة المستشفيات',
                'description' => 'نظام متكامل لإدارة جميع عمليات المستشفى من حجز المواعيد إلى إدارة المرضى والسجلات الطبية.',
                'technologies' => 'Laravel, Vue.js, MySQL, Redis',
                'category' => 'web',
                'github_url' => 'https://github.com/nawaf/hospital-system',
                'demo_url' => 'https://hospital.demo.com',
                'play_store_url' => null,
                'completed_at' => '2024-03-15',
                'order' => 1,
                'images' => [
                    ['image_path' => 'projects/hospital-1.jpg', 'order' => 1],
                    ['image_path' => 'projects/hospital-2.jpg', 'order' => 2],
                ]
            ],
            [
                'title' => 'تطبيق متجر إلكتروني',
                'description' => 'تطبيق جوال لمتجر إلكتروني متكامل مع نظام دفع إلكتروني وتتبع الطلبات.',
                'technologies' => 'Flutter, Laravel, Firebase, Stripe',
                'category' => 'mobile',
                'github_url' => 'https://github.com/nawaf/ecommerce-app',
                'demo_url' => null,
                'play_store_url' => 'https://play.google.com/store/apps/details?id=com.nawaf.ecommerce',
                'completed_at' => '2024-02-20',
                'order' => 2,
                'images' => [
                    ['image_path' => 'projects/ecommerce-1.jpg', 'order' => 1],
                    ['image_path' => 'projects/ecommerce-2.jpg', 'order' => 2],
                    ['image_path' => 'projects/ecommerce-3.jpg', 'order' => 3],
                ]
            ],
            [
                'title' => 'منصة التعلم الإلكتروني',
                'description' => 'منصة تعليمية متكاملة لدورات تعليمية مع نظام اختبارات وشهادات معتمدة.',
                'technologies' => 'React, Node.js, MongoDB, AWS',
                'category' => 'web',
                'github_url' => 'https://github.com/nawaf/elearning-platform',
                'demo_url' => 'https://elearning.demo.com',
                'play_store_url' => null,
                'completed_at' => '2024-01-10',
                'order' => 3,
                'images' => [
                    ['image_path' => 'projects/elearning-1.jpg', 'order' => 1],
                    ['image_path' => 'projects/elearning-2.jpg', 'order' => 2],
                ]
            ],
            [
                'title' => 'نظام إدارة المشاريع',
                'description' => 'أداة متكاملة لإدارة المهام والمشاريع مع لوحة تحكم تفاعلية وإشعارات في الوقت الفعلي.',
                'technologies' => 'Laravel, Livewire, MySQL, Pusher',
                'category' => 'web',
                'github_url' => 'https://github.com/nawaf/project-management',
                'demo_url' => 'https://projects.demo.com',
                'play_store_url' => null,
                'completed_at' => '2023-12-05',
                'order' => 4,
                'images' => [
                    ['image_path' => 'projects/project-1.jpg', 'order' => 1],
                    ['image_path' => 'projects/project-2.jpg', 'order' => 2],
                ]
            ],
            [
                'title' => 'تطبيق الطقس',
                'description' => 'تطبيق جوال متقدم للطقس مع تحديثات فورية وتنبيهات وتوقعات مفصلة.',
                'technologies' => 'React Native, OpenWeather API, Redux',
                'category' => 'mobile',
                'github_url' => 'https://github.com/nawaf/weather-app',
                'demo_url' => null,
                'play_store_url' => 'https://play.google.com/store/apps/details?id=com.nawaf.weather',
                'completed_at' => '2023-11-15',
                'order' => 5,
                'images' => [
                    ['image_path' => 'projects/weather-1.jpg', 'order' => 1],
                    ['image_path' => 'projects/weather-2.jpg', 'order' => 2],
                ]
            ],
            [
                'title' => 'موقع محفظة أعمال',
                'description' => 'موقع شخصي متكامل لعرض المشاريع والمهارات والخبرات بشكل احترافي.',
                'technologies' => 'Laravel, Tailwind CSS, Alpine.js',
                'category' => 'web',
                'github_url' => 'https://github.com/nawaf/portfolio',
                'demo_url' => 'https://nawaf.com',
                'play_store_url' => null,
                'completed_at' => '2023-10-01',
                'order' => 6,
                'images' => [
                    ['image_path' => 'projects/portfolio-1.jpg', 'order' => 1],
                    ['image_path' => 'projects/portfolio-2.jpg', 'order' => 2],
                ]
            ],
        ];

        foreach ($projects as $projectData) {
            $images = $projectData['images'];
            unset($projectData['images']);
            
            $project = Project::create($projectData);
            
            foreach ($images as $image) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $image['image_path'],
                    'order' => $image['order'],
                ]);
            }
        }

        $this->command->info('✅ تم إنشاء ' . count($projects) . ' مشروع بنجاح');
    }
}