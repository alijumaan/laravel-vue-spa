<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Period::create(['period' => 'monthly']);
        Period::create(['period' => 'every three months']);
        Period::create(['period' => 'every six months']);
        Period::create(['period' => 'yearly']);
    }
}
