<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'ABC CORP',
                'address' => 'ABC CORP',
            ],
            [
                'name' => 'DEF CORP',
                'address' => 'DEF CORP',
            ],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
