<?php

namespace Database\Seeders;

use App\Models\EmployeeAllowance;
use Illuminate\Database\Seeder;

class EmployeeAllowanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10000; $i++) {
            EmployeeAllowance::create([
                'employee_id' => fake()->numberBetween(1, 2000),
                'allowance_id' => fake()->numberBetween(1, 5),
                'month' => fake()->monthName,
                'amount' => fake()->numberBetween(10000, 50000),
            ]);
        }
    }
}
