<?php



namespace Database\Factories\App;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Thread;
use Illuminate\Support\Str;

class ThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thread::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;

        return [
            'user_id' => function () {
                return factory('App\User')->create()->id;
            },
            'channel_id' => function () {
                return factory('App\Channel')->create()->id;
            },
            'title' => $title,
            'body' => $this->faker->paragraph,
            'slug' => Str::slug($title),
            'locked' => false,
        ];
    }
}
