<?php



namespace Database\Factories\App;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Model;

class Channel extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Channel::class;

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
            'slug' => $name,

        ];
    }
}
