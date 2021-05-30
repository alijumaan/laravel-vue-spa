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
        Period::create(['period' => 'شهري']);
        Period::create(['period' => 'كل ثلاث أشهر']);
        Period::create(['period' => 'كل ستة أشهر']);
        Period::create(['period' => 'سنوي']);
    }
}
