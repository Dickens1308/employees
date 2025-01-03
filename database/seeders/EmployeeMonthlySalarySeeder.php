<?php

namespace Database\Seeders;

use App\Models\EmployeeMonthlySalary;
use Illuminate\Database\Seeder;

class EmployeeMonthlySalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10000; $i++) {
            $basic_salary = fake()->numberBetween(500000, 1700000);
            $total_salary = $basic_salary + fake()->numberBetween(20000, 100000);

            EmployeeMonthlySalary::create([
                'employee_id' => fake()->numberBetween(1, 2000),
                'month' => fake()->monthName,
                'total_salary' => $total_salary,
            ]);
        }
    }
}
