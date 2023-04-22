<?php

namespace Database\Seeders;

use App\Models\EmployeeProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeeProjects = [
            [
                'employee_id' => 1,
                'project_id' => 1,
            ],
            [
                'employee_id' => 2,
                'project_id' => 2,
            ],
        ];

        foreach ($employeeProjects as $EmployeeProject) {
            EmployeeProject::create($EmployeeProject);
        }
    }
}
