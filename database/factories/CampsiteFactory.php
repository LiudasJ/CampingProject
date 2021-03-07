<?php

namespace Database\Factories;

use App\Models\Campsite;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CampsiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campsite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name . "Camping",
            'country' => $this->faker->name . "Land",
            'city' => $this->faker->name . "City",
            'website' => 'www.proalpha.de',
            'rating' => rand(1, 5),
            'img_path' => '../images/camping.jpg',
        ];
    }
}
