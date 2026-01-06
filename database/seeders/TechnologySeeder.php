<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    public function run(): void
    {
        $technologies = [
            ['name' => 'Laravel', 'icon' => 'fab fa-laravel'],
            ['name' => 'React', 'icon' => 'fab fa-react'],
            ['name' => 'Vue.js', 'icon' => 'fab fa-vuejs'],
            ['name' => 'Node.js', 'icon' => 'fab fa-node-js'],
            ['name' => 'MySQL', 'icon' => 'fas fa-database'],
            ['name' => 'MongoDB', 'icon' => 'fas fa-database'],
            ['name' => 'Docker', 'icon' => 'fab fa-docker'],
            ['name' => 'AWS', 'icon' => 'fab fa-aws'],
            ['name' => 'Git', 'icon' => 'fab fa-git-alt'],
            ['name' => 'PHP', 'icon' => 'fab fa-php'],
            ['name' => 'JavaScript', 'icon' => 'fab fa-js'],
            ['name' => 'Python', 'icon' => 'fab fa-python'],
            ['name' => 'HTML5', 'icon' => 'fab fa-html5'],
            ['name' => 'CSS3', 'icon' => 'fab fa-css3-alt'],
            ['name' => 'Bootstrap', 'icon' => 'fab fa-bootstrap'],
            ['name' => 'Tailwind CSS', 'icon' => 'fas fa-wind'],
            ['name' => 'WordPress', 'icon' => 'fab fa-wordpress'],
            ['name' => 'Flutter', 'icon' => 'fas fa-mobile-alt'],
            ['name' => 'React Native', 'icon' => 'fab fa-react'],
        ];

        foreach ($technologies as $technology) {
            Technology::create($technology);
        }

        $this->command->info('✅ تم إنشاء ' . count($technologies) . ' تقنية بنجاح');
    }
}