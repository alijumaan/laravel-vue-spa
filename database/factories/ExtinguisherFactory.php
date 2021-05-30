<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Extinguisher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExtinguisherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Extinguisher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $extinguisher_type = $this->faker->randomElement($array = array ('ماء','رغوة','بودرة', 'ثاني اكسيد الكربون'));
        return [
            'type' => $extinguisher_type,
        ];
    }
}
