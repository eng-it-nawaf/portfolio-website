<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Service;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
                $this->call([
            ServicesTableSeeder::class,
            // باقي seeders هنا...
        ]);

//         $this->call([
//     ProjectTechnologySeeder::class,
//     AdminUserSeeder::class,
// ]);
        // إضافة بيانات وهمية للخبرات (Experiences)
        // $experiences = [
        //     [
        //         'title' => 'مطور ويب',
        //         'company' => 'شركة التقنية المتقدمة',
        //         'description' => 'تطوير وتصميم تطبيقات الويب باستخدام Laravel و Vue.js',
        //         'start_date' => Carbon::create('2020', '01', '15'),
        //         'end_date' => null,
        //         'is_current' => true,
        //         'type' => 'work'
        //     ],
        //     [
        //         'title' => 'مهندس برمجيات',
        //         'company' => 'شركة الحلول الذكية',
        //         'description' => 'تطوير أنظمة إدارة المشاريع وتحليل البيانات',
        //         'start_date' => Carbon::create('2018', '06', '01'),
        //         'end_date' => Carbon::create('2019', '12', '31'),
        //         'is_current' => false,
        //         'type' => 'work'
        //     ],
        //     [
        //         'title' => 'بكالوريوس في علوم الحاسوب',
        //         'company' => 'جامعة المدينة',
        //         'description' => 'تخرجت بامتياز مع مرتبة الشرف',
        //         'start_date' => Carbon::create('2014', '09', '01'),
        //         'end_date' => Carbon::create('2018', '06', '30'),
        //         'is_current' => false,
        //         'type' => 'education'
        //     ],
        //     [
        //         'title' => 'دبلوم تطوير الويب',
        //         'company' => 'معهد التكنولوجيا',
        //         'description' => 'تدريب مكثف على تطوير الويب لمدة 6 أشهر',
        //         'start_date' => Carbon::create('2019', '01', '10'),
        //         'end_date' => Carbon::create('2019', '07', '10'),
        //         'is_current' => false,
        //         'type' => 'education'
        //     ]
        // ];

        // foreach ($experiences as $experience) {
        //     Experience::create($experience);
        // }

        // // إضافة بيانات وهمية للمهارات (Skills)
        // $skills = [
        //     [
        //         'name' => 'PHP',
        //         'percentage' => 90,
        //         'icon' => 'FaPhp',
        //         'category' => 'Programming Languages',
        //         'order' => 1
        //     ],
        //     [
        //         'name' => 'Laravel',
        //         'percentage' => 85,
        //         'icon' => 'FaLaravel',
        //         'category' => 'Frameworks',
        //         'order' => 2
        //     ],
        //     [
        //         'name' => 'JavaScript',
        //         'percentage' => 80,
        //         'icon' => 'FaJs',
        //         'category' => 'Programming Languages',
        //         'order' => 3
        //     ],
        //     [
        //         'name' => 'Vue.js',
        //         'percentage' => 75,
        //         'icon' => 'FaVuejs',
        //         'category' => 'Frameworks',
        //         'order' => 4
        //     ],
        //     [
        //         'name' => 'HTML/CSS',
        //         'percentage' => 95,
        //         'icon' => 'FaHtml5',
        //         'category' => 'Web Development',
        //         'order' => 5
        //     ],
        //     [
        //         'name' => 'MySQL',
        //         'percentage' => 80,
        //         'icon' => 'FaDatabase',
        //         'category' => 'Databases',
        //         'order' => 6
        //     ],
        //     [
        //         'name' => 'Git',
        //         'percentage' => 85,
        //         'icon' => 'FaGitAlt',
        //         'category' => 'Design & Tools',
        //         'order' => 7
        //     ],
        //     [
        //         'name' => 'Linux',
        //         'percentage' => 70,
        //         'icon' => 'FaLinux',
        //         'category' => 'Operating Systems',
        //         'order' => 8
        //     ],
        //     [
        //         'name' => 'Docker',
        //         'percentage' => 65,
        //         'icon' => 'FaDocker',
        //         'category' => 'Web Development',
        //         'order' => 9
        //     ],
        //     [
        //         'name' => 'React',
        //         'percentage' => 60,
        //         'icon' => 'FaReact',
        //         'category' => 'Frameworks',
        //         'order' => 10
        //     ]
        // ];

        // foreach ($skills as $skill) {
        //     Skill::create($skill);
        // }
    }
}