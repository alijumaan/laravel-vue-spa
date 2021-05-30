<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'مدير النظام',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'علي القحطاني',
            'username' => 'ali',
            'email' => 'ali@ali.com',
            'password' => bcrypt('ali'),
            'role_id' => 2,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'ياسر',
            'username' => 'yasser',
            'email' => 'yasser@yasser.com',
            'password' => bcrypt('yasser'),
            'role_id' => 3,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'سعد',
            'username' => 'saad',
            'email' => 'saad@saad.com',
            'password' => bcrypt('saad'),
            'role_id' => 3,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'احمد',
            'username' => 'ahmed',
            'email' => 'ahmed@ahmed.com',
            'password' => bcrypt('ahmed'),
            'role_id' => 3,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
