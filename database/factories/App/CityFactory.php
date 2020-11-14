<?php

namespace Database\Factories\App;

use App\City;
use App\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'country_id' => function () {
                return create('App\Country')->id;
            },
        ];
    }
}
