<?php

namespace Database\Seeders;

use App\Models\Extinguisher;
use Illuminate\Database\Seeder;

class ExtinguisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Extinguisher::create([
            'type' => 'water',
        ]);

        Extinguisher::create([
            'type' => 'foam',
        ]);

        Extinguisher::create([
            'type' => 'powder',
        ]);

        Extinguisher::create([
            'type' => 'co2',
        ]);
    }
}
