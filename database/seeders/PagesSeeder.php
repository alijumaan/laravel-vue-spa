<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'title' => "About us",
            'slug' => "about-us",
            'content' => "Safety and fire management application",
        ]);

        DB::table('pages')->insert([
            'title' => "Contact us",
            'slug' => "contact-us",
            'content' => "Contact us",
        ]);

        DB::table('pages')->insert([
            'title' => "Policy and Privacy",
            'slug' => "policy-and-privacy",
            'content' => "Policy and Privacy here...",
        ]);
    }
}
