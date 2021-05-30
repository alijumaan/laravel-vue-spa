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
            'name' => 'الرئيسية',
            'to' => '/',
            'icon' => 'home',
            'access' => TRUE
        ]);

        Link::create([
            'name' => 'المباني',
            'to' => '/buildings',
            'icon' => 'building',
            'access' => TRUE
        ]);

        Link::create([
            'name' => 'الطفايات',
            'to' => '/extinguishers',
            'icon' => 'fire-extinguisher',
            'access' => TRUE
        ]);

        Link::create([
            'name' => 'الصفحات',
            'to' => '/pages',
            'icon' => 'file',
            'access' => FALSE
        ]);

        Link::create([
            'name' => 'الصفحة الشخصية',
            'to' => '/user/profile',
            'icon' => 'user',
            'access' => TRUE
        ]);

        Link::create([
            'name' => 'الإعدادات',
            'to' => '/user/setting',
            'icon' => 'cog',
            'access' => TRUE
        ]);

        Link::create([
            'name' => 'رسائل التواصل',
            'to' => '/contacts',
            'icon' => 'comment',
            'access' => FALSE
        ]);

        Link::create([
            'name' => 'الملاحظات والشكاوي',
            'to' => '/contacts/create',
            'icon' => 'comment',
            'access' => TRUE
        ]);
    }
}
