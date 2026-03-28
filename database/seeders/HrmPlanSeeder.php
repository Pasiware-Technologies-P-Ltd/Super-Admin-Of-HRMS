<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HrmPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('hrm_plan')->insert([
            [
                'plan_name' => 'Basic Plan',
                'description' => 'Up to 50 employees',
                'price' => 5000.00,
                'employee_per_price' => 100.00,
                'employee_capacity' => 50,
                'status' => 'active'
            ],
            [
                'plan_name' => 'Standard Plan',
                'description' => 'Up to 150 employees',
                'price' => 12000.00,
                'employee_per_price' => 80.00,
                'employee_capacity' => 150,
                'status' => 'active'
            ],
            [
                'plan_name' => 'Enterprise Plan',
                'description' => 'Up to 500 employees',
                'price' => 35000.00,
                'employee_per_price' => 50.00,
                'employee_capacity' => 500,
                'status' => 'active'
            ]
        ]);
    }
}
