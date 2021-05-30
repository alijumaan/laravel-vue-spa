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
            'bio' => 'مؤسس موقع إدارة السلامة'
        ]);
        Profile::create([
            'user_id' => '2',
            'avatar' => 'avatar.png',
            'bio' => 'مشرف الموقع'
        ]);
        Profile::create([
            'user_id' => '3',
            'avatar' => 'avatar.png',
            'bio' => 'مفتش السلامة'
        ]);

    }
}
