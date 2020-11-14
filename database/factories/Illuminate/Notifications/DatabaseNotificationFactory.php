<?php



namespace Database\Factories\Illuminate\Notifications;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Model;
use Ramsey\Uuid\Uuid;

class UserNotifications extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Illuminate\Notifications\DatabaseNotification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Uuid::uuid4()->toString(),

            'type' => 'App\Notifications\ThreadWasUpdated',
            'notifiable_id' => function () {
                return auth()->id() ?: factory('App\User')->create()->id;
            },
            'notifiable_type' => 'App\User',
            'data' => ['foo' => 'bar'],

        ];
    }
}
