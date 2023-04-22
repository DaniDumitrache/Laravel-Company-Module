<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'company_id' => 1,
                'name' => 'ABC CORP',
                'description' => 'ABC CORP Description'
            ],
            [
                'company_id' => 2,
                'name' => 'DEF CORP',
                'description' => 'DEF CORP Description'
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
