<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BuildingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Building::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $building_name =$this->faker->sentence;
        return [
            'name' => $building_name,
            'slug' => Str::slug($building_name),
            'number' => $this->faker->numberBetween(719, 730),
            'status' => $this->faker->numberBetween(0, 1),
            'user_id' => User::all()->random()->id,
            'checked_at' => $this->faker->dateTimeBetween('-1 year', 'now', 'Asia/Riyadh'),
//            'checked_at' => null
        ];
    }
}
