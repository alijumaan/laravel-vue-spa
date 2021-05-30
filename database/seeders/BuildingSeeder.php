<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Building::create([
            'name' => 'التموين',
            'slug' => 'التموين',
            'number' => 345,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'المطعم',
            'slug' => 'المطعم',
            'number' => 221,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'الادارة',
            'slug' => 'الادارة',
            'number' => 235,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'الحديقة',
            'slug' => 'الحديقة',
            'number' => 500,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'الملعب',
            'slug' => 'الملعب',
            'number' => 233,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'المستودعات',
            'slug' => 'المستودعات',
            'number' => 549,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'المصنع',
            'slug' => 'المصنع',
            'number' => 234,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'المسجد',
            'slug' => 'المسجد',
            'number' => 767,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'البوابة',
            'slug' => 'البوابة',
            'number' => 670,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'المواقف',
            'slug' => 'المواقف',
            'number' => 498,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'الكراج',
            'slug' => 'الكراج',
            'number' => 465,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'السينما',
            'slug' => 'السينما',
            'number' => 465,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'السوبر ماركت',
            'slug' => 'السوبر-ماركت',
            'number' => 575,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'الصالون',
            'slug' => 'الصالون',
            'number' => 509,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'النادي الصحي',
            'slug' => 'النادي-الصحي',
            'number' => 509,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);

        Building::create([
            'name' => 'المسبح',
            'slug' => 'المسبح',
            'number' => 509,
            'status' => rand(0, 1),
            'period_id' => rand(1, 4),
            'notes' => 'لاتوجد ملاحظات',
            'user_id' => rand(2, 5),
            'created_at' => now(),
            'updated_at' => now(),
            'checked_at' => now(),
        ]);
    }
}
