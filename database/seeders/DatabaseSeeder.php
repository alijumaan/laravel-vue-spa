<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\User::factory(10)->create();

        $this->call(PermissionsSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(PeriodSeeder::class);
        $this->call(BuildingSeeder::class);
        $this->call(ExtinguisherSeeder::class);
        $this->call(BuildingExtinguisherSeeder::class);
        $this->call(LinkSeeder::class);
    }
}
