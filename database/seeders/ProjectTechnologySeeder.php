<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;

class ProjectTechnologySeeder extends Seeder
{
    public function run()
    {
        $projects = Project::all();
        $technologies = Technology::all();

        foreach ($projects as $project) {
            $project->technologies()->attach(
                $technologies->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}