<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Link::create([
            'name' => 'home',
            'to' => '/',
            'icon' => 'home',
            'access' => 1
        ]);

        Link::create([
            'name' => 'pages',
            'to' => '/pages',
            'icon' => 'file',
            'access' => 0
        ]);

        Link::create([
            'name' => 'profile',
            'to' => '/user/profile',
            'icon' => 'user',
            'access' => 1
        ]);

        Link::create([
            'name' => 'settings',
            'to' => '/user/setting',
            'icon' => 'cog',
            'access' => 1
        ]);

        Link::create([
            'name' => 'messages',
            'to' => '/contacts',
            'icon' => 'comment',
            'access' => 0
        ]);

        Link::create([
            'name' => 'contacts',
            'to' => '/contacts/create',
            'icon' => 'comment',
            'access' => 1
        ]);
    }
}
