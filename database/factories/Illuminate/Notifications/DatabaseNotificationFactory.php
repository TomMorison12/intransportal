<?php

namespace Database\Factories\Illuminate\Notifications;

use App\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class DatabaseNotificationFactory extends Factory
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
