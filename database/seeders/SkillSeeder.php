<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            // لغات البرمجة
            ['name' => 'PHP', 'percentage' => 95, 'icon' => 'fab fa-php', 'category' => 'Programming Languages', 'order' => 1],
            ['name' => 'JavaScript', 'percentage' => 90, 'icon' => 'fab fa-js', 'category' => 'Programming Languages', 'order' => 2],
            ['name' => 'Python', 'percentage' => 85, 'icon' => 'fab fa-python', 'category' => 'Programming Languages', 'order' => 3],
            ['name' => 'Java', 'percentage' => 80, 'icon' => 'fab fa-java', 'category' => 'Programming Languages', 'order' => 4],
            
            // تطوير الويب
            ['name' => 'Laravel', 'percentage' => 95, 'icon' => 'fab fa-laravel', 'category' => 'Web Development', 'order' => 1],
            ['name' => 'React.js', 'percentage' => 90, 'icon' => 'fab fa-react', 'category' => 'Web Development', 'order' => 2],
            ['name' => 'Vue.js', 'percentage' => 85, 'icon' => 'fab fa-vuejs', 'category' => 'Web Development', 'order' => 3],
            ['name' => 'Node.js', 'percentage' => 80, 'icon' => 'fab fa-node-js', 'category' => 'Web Development', 'order' => 4],
            
            // قواعد البيانات
            ['name' => 'MySQL', 'percentage' => 90, 'icon' => 'fas fa-database', 'category' => 'Databases', 'order' => 1],
            ['name' => 'PostgreSQL', 'percentage' => 85, 'icon' => 'fas fa-database', 'category' => 'Databases', 'order' => 2],
            ['name' => 'MongoDB', 'percentage' => 80, 'icon' => 'fas fa-database', 'category' => 'Databases', 'order' => 3],
            
            // أدوات التطوير
            ['name' => 'Git', 'percentage' => 95, 'icon' => 'fab fa-git-alt', 'category' => 'Development Tools', 'order' => 1],
            ['name' => 'Docker', 'percentage' => 85, 'icon' => 'fab fa-docker', 'category' => 'Development Tools', 'order' => 2],
            ['name' => 'AWS', 'percentage' => 80, 'icon' => 'fab fa-aws', 'category' => 'Development Tools', 'order' => 3],
            
            // التصميم
            ['name' => 'Figma', 'percentage' => 90, 'icon' => 'fab fa-figma', 'category' => 'Design', 'order' => 1],
            ['name' => 'Adobe XD', 'percentage' => 85, 'icon' => 'fas fa-paint-brush', 'category' => 'Design', 'order' => 2],
            ['name' => 'Photoshop', 'percentage' => 80, 'icon' => 'fab fa-adobe', 'category' => 'Design', 'order' => 3],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        $this->command->info('✅ تم إنشاء ' . count($skills) . ' مهارة بنجاح');
    }
}