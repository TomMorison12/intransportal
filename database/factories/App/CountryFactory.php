<?php



namespace Database\Factories\App;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Country;
use Illuminate\Support\Str;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
