<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['id' => 1, 'role' => 'مدير']);

        DB::table('roles')->insert(['id' => 2, 'role' => 'مشرف']);

        DB::table('roles')->insert(['id' => 3, 'role' => 'مستخدم']);

    }
}
