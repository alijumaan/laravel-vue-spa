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
            'title' => "نبذة عنا",
            'slug' => "نبذة-عنا",
            'content' => "تطبيق إدارة السلامة والاطفاء",
        ]);

        DB::table('pages')->insert([
            'title' => "اتصل بنا",
            'slug' => "اتصل-بنا",
            'content' => "اتصل بنا",
        ]);

        DB::table('pages')->insert([
            'title' => "السياسة والخصوصية",
            'slug' => "السياسة-والخصوصية",
            'content' => "السياسة والخصوصية",
        ]);
    }
}
