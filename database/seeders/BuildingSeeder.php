<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Building::create([
            'name' => 'Supplies',
            'slug' => 'supply',
            'number' => 345,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Restaurant',
            'slug' => 'restaurant',
            'number' => 221,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Administration',
            'slug' => 'administration',
            'number' => 235,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Garden',
            'slug' => 'garden',
            'number' => 500,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Stadium',
            'slug' => 'stadium',
            'number' => 233,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Stores',
            'slug' => 'stores',
            'number' => 549,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Factories',
            'slug' => 'factories',
            'number' => 234,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Masjid',
            'slug' => 'masjid',
            'number' => 767,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Gates',
            'slug' => 'gates',
            'number' => 670,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Parking',
            'slug' => 'parking',
            'number' => 498,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Garage',
            'slug' => 'garage',
            'number' => 465,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Cinema',
            'slug' => 'cinema',
            'number' => 465,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Super market',
            'slug' => 'super-market',
            'number' => 575,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Salon',
            'slug' => 'salon',
            'number' => 509,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Club',
            'slug' => 'club',
            'number' => 509,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'Swimming pool',
            'slug' => 'swimming-pool',
            'number' => 509,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'No notes',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);
    }
}
