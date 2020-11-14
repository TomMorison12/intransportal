<?php



namespace Database\Factories\App;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Reply;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return factory('App\User')->create()->id;
            },
            'thread_id' => function () {
                return factory('App\Thread')->create()->id;
            },
            'body' => $this->faker->paragraph,
        ];
    }
}
