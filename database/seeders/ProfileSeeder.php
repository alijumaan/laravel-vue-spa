<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'user_id' => '1',
            'avatar' => 'avatar.png',
            'bio' => 'Administrator'
        ]);
        Profile::create([
            'user_id' => '2',
            'avatar' => 'avatar.png',
            'bio' => 'Supervisor'
        ]);
        Profile::create([
            'user_id' => '3',
            'avatar' => 'avatar.png',
            'bio' => 'Inspector'
        ]);

    }
}
