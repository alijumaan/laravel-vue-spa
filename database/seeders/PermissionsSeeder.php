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
        DB::table('permissions')->insert(['name' => 'view-permissions', 'description' => 'عرض الصلاحيات', 'message' => 'غير مصرح لك عرض الصلاحيات']);

        DB::table('permissions')->insert(['name' => 'add-building', 'description' => 'إضافة مباني', 'message' => 'غير مصرح لك إضافة مباني']);
        DB::table('permissions')->insert(['name' => 'add-building', 'description' => 'إضافة مباني', 'message' => 'غير مصرح لك إضافة مباني']);
        DB::table('permissions')->insert(['name' => 'edit-building', 'description' => 'تعديل مبنى', 'message' => 'غير مصرح لك تعديل مبنى']);
        DB::table('permissions')->insert(['name' => 'delete-building', 'description' => 'حذف مبنى', 'message' => 'غير مصرح لك حذف مبنى']);

        DB::table('permissions')->insert(['name' => 'add-extinguisher', 'description' => 'إضافة طفاية', 'message' => 'غير مصرح لك إضافة طفاية']);
        DB::table('permissions')->insert(['name' => 'edit-extinguisher', 'description' => 'تعديل طفاية', 'message' => 'غير مصرح لك تعديل طفاية']);
        DB::table('permissions')->insert(['name' => 'delete-extinguisher', 'description' => 'حذف طفاية', 'message' => 'غير مصرح لك حذف طفاية']);

        DB::table('permissions')->insert(['name' => 'add-page', 'description' => 'إضافة صفحة', 'message' => 'غير مصرح لك إضافة صفحة']);
        DB::table('permissions')->insert(['name' => 'edit-page', 'description' => 'تعديل صفحة', 'message' => 'غير مصرح لك تعديل صفحة']);
        DB::table('permissions')->insert(['name' => 'delete-page', 'description' => 'حذف صفحة', 'message' => 'غير مصرح لك حذف صفحة']);

        DB::table('permissions')->insert(['name' => 'add-user', 'description' => 'إضافة المستخدمين', 'message' => 'غير مصرح لك إضافة المستخدمين']);
        DB::table('permissions')->insert(['name' => 'edit-user', 'description' => 'تعديل بيانات المستخدمين', 'message' => 'غير مصرح لك تعديل بيانات المستخدمين']);
        DB::table('permissions')->insert(['name' => 'delete-user', 'description' => 'حذف المستخدمين', 'message' => 'غير مصرح لك حذف المستخدمين']);
        DB::table('permissions')->insert(['name' => 'restore-user', 'description' => 'استعادة مستخدم محذوف', 'message' => 'غير مصرح لك استعادة مستخدم محذوف']);
        DB::table('permissions')->insert(['name' => 'force-delete-user', 'description' => 'حذف مستخدم نهائياً', 'message' => 'غير مصرح لك حذف مستخدم نهائياً']);

        DB::table('permissions')->insert(['name' => 'delete-contact', 'description' => 'حذف الرسالةً', 'message' => 'غير مصرح لك حذف الرسالةً']);
        DB::table('permissions')->insert(['name' => 'view-contacts', 'description' => 'عرض الرسالةً', 'message' => 'غير مصرح لك عرض الرسالةً']);

        DB::table('permissions')->insert(['name' => 'show-link', 'description' => 'عرض الرابط', 'message' => 'غير مصرح لك عرض الرابط']);
        DB::table('permissions')->insert(['name' => 'add-link', 'description' => 'اضافة الرابط', 'message' => 'غير مصرح لك اضافة الرابط']);
        DB::table('permissions')->insert(['name' => 'edit-link', 'description' => 'تعديل الرابط', 'message' => 'غير مصرح لك تعديل الرابط']);
        DB::table('permissions')->insert(['name' => 'delete-link', 'description' => 'حذف الرابط', 'message' => 'غير مصرح لك حذف الرابط']);
    }
}
