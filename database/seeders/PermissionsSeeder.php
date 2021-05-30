<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(['name' => 'add-building', 'description' => 'إضافة مباني']);
        DB::table('permissions')->insert(['name' => 'edit-building', 'description' => 'تعديل مبنى']);
        DB::table('permissions')->insert(['name' => 'delete-building', 'description' => 'حذف مبنى']);

        DB::table('permissions')->insert(['name' => 'add-extinguisher', 'description' => 'إضافة طفاية']);
        DB::table('permissions')->insert(['name' => 'edit-extinguisher', 'description' => 'تعديل طفاية']);
        DB::table('permissions')->insert(['name' => 'delete-extinguisher', 'description' => 'حذف طفاية']);

        DB::table('permissions')->insert(['name' => 'add-page', 'description' => 'إضافة صفحة']);
        DB::table('permissions')->insert(['name' => 'edit-page', 'description' => 'تعديل صفحة']);
        DB::table('permissions')->insert(['name' => 'delete-page', 'description' => 'حذف صفحة']);

        DB::table('permissions')->insert(['name' => 'add-user', 'description' => 'إضافة المستخدمين']);
        DB::table('permissions')->insert(['name' => 'edit-user', 'description' => 'تعديل بيانات المستخدمين']);
        DB::table('permissions')->insert(['name' => 'delete-user', 'description' => 'حذف المستخدمين']);
        DB::table('permissions')->insert(['name' => 'restore-user', 'description' => 'استعادة مستخدم محذوف']);
        DB::table('permissions')->insert(['name' => 'force-delete-user', 'description' => 'حذف مستخدم نهائياً']);

        DB::table('permissions')->insert(['name' => 'delete-message', 'description' => 'حذف الرسالةً']);
        DB::table('permissions')->insert(['name' => 'show-message', 'description' => 'عرض الرسالةً']);

        DB::table('permissions')->insert(['name' => 'show-link', 'description' => 'عرض الرابط']);
        DB::table('permissions')->insert(['name' => 'add-link', 'description' => 'اضافة الرابط']);
        DB::table('permissions')->insert(['name' => 'edit-link', 'description' => 'تعديل الرابط']);
        DB::table('permissions')->insert(['name' => 'delete-link', 'description' => 'حذف الرابط']);
    }
}
