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
            'name' => 'Home',
            'to' => '/',
            'icon' => 'home',
            'access' => TRUE
        ]);

        Link::create([
            'name' => 'Buildings',
            'to' => '/buildings',
            'icon' => 'building',
            'access' => TRUE
        ]);

        Link::create([
            'name' => 'Extinguishers',
            'to' => '/extinguishers',
            'icon' => 'fire-extinguisher',
            'access' => TRUE
        ]);

        Link::create([
            'name' => 'Pages',
            'to' => '/pages',
            'icon' => 'file',
            'access' => FALSE
        ]);

        Link::create([
            'name' => 'Profile',
            'to' => '/user/profile',
            'icon' => 'user',
            'access' => TRUE
        ]);

        Link::create([
            'name' => 'Settings',
            'to' => '/user/setting',
            'icon' => 'cog',
            'access' => TRUE
        ]);

        Link::create([
            'name' => 'Contacts',
            'to' => '/contacts',
            'icon' => 'comment',
            'access' => FALSE
        ]);

        Link::create([
            'name' => 'Contact us',
            'to' => '/contacts/create',
            'icon' => 'comment',
            'access' => TRUE
        ]);
    }
}
