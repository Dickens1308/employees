<?php

namespace Database\Seeders;

use App\Models\Allowance;
use Illuminate\Database\Seeder;

class AllowanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Allowance::create(['name' => 'Food']);
        Allowance::create(['name' => 'Transport']);
        Allowance::create(['name' => 'Communication']);
        Allowance::create(['name' => 'Child Care']);
        Allowance::create(['name' => 'School Fee']);
    }
}
