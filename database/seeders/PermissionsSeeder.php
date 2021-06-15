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
        DB::table('permissions')->insert(['name' => 'view-permission', 'description' => 'view permission', 'message' => 'You dont allow to view permission']);
        DB::table('permissions')->insert(['name' => 'add-permission', 'description' => 'add permission', 'message' => 'You dont allow to add permission']);
        DB::table('permissions')->insert(['name' => 'edit-permission', 'description' => 'edit permission', 'message' => 'You dont allow to edit permission']);
        DB::table('permissions')->insert(['name' => 'delete-permission', 'description' => 'delete permission', 'message' => 'You dont allow to delete permission']);

        DB::table('permissions')->insert(['name' => 'view-building', 'description' => 'view building', 'message' => 'You dont allow to view building']);
        DB::table('permissions')->insert(['name' => 'add-building', 'description' => 'add building', 'message' => 'You dont allow to add building']);
        DB::table('permissions')->insert(['name' => 'edit-building', 'description' => 'edit building', 'message' => 'You dont allow to edit building']);
        DB::table('permissions')->insert(['name' => 'delete-building', 'description' => 'delete building', 'message' => 'You dont allow to delete building']);

        DB::table('permissions')->insert(['name' => 'view-extinguisher', 'description' => 'view extinguisher', 'message' => 'You dont allow to view an extinguisher']);
        DB::table('permissions')->insert(['name' => 'add-extinguisher', 'description' => 'add extinguisher', 'message' => 'You dont allow to add an extinguisher']);
        DB::table('permissions')->insert(['name' => 'edit-extinguisher', 'description' => 'edit extinguisher', 'message' => 'You dont allow to edit an extinguisher']);
        DB::table('permissions')->insert(['name' => 'delete-extinguisher', 'description' => 'delete extinguisher', 'message' => 'You dont allow to delete an extinguisher']);

        DB::table('permissions')->insert(['name' => 'view-page', 'description' => 'view page', 'message' => 'You dont allow to view page']);
        DB::table('permissions')->insert(['name' => 'add-page', 'description' => 'add page', 'message' => 'You dont allow to add page']);
        DB::table('permissions')->insert(['name' => 'edit-page', 'description' => 'edit page', 'message' => 'You dont allow to edit page']);
        DB::table('permissions')->insert(['name' => 'delete-page', 'description' => 'delete page', 'message' => 'You dont allow to delete page']);

        DB::table('permissions')->insert(['name' => 'view-user', 'description' => 'view user', 'message' => 'You dont allow to view user']);
        DB::table('permissions')->insert(['name' => 'add-user', 'description' => 'add user', 'message' => 'You dont allow to add user']);
        DB::table('permissions')->insert(['name' => 'edit-user', 'description' => 'edit user', 'message' => 'You dont allow to edit user']);
        DB::table('permissions')->insert(['name' => 'delete-user', 'description' => 'delete user', 'message' => 'You dont allow to delete user']);
        DB::table('permissions')->insert(['name' => 'restore-user', 'description' => 'restore user', 'message' => 'You dont allow to restore user']);
        DB::table('permissions')->insert(['name' => 'force-delete-user', 'description' => 'force delete userً', 'message' => 'You dont allow to force delete user']);

        DB::table('permissions')->insert(['name' => 'view-contact', 'description' => 'view contact', 'message' => 'You dont allow to view contact']);
        DB::table('permissions')->insert(['name' => 'delete-contact', 'description' => 'delete contact', 'message' => 'You dont allow to delete contact']);

        DB::table('permissions')->insert(['name' => 'viw-link', 'description' => 'viw link', 'message' => 'You dont allow to viw link']);
        DB::table('permissions')->insert(['name' => 'add-link', 'description' => 'add link', 'message' => 'You dont allow to add link']);
        DB::table('permissions')->insert(['name' => 'edit-link', 'description' => 'edit link', 'message' => 'You dont allow to edit link']);
        DB::table('permissions')->insert(['name' => 'delete-link', 'description' => 'delete link', 'message' => 'You dont allow to delete link']);
    }
}
