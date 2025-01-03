<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 2000; $i++) {
            Employee::create([
                'name' => fake()->name,
                'gender' => fake()->randomElement(['Male', 'Female']),
                'basic_salary' => fake()->numberBetween(500000, 1700000),
            ]);
        }
    }
}
