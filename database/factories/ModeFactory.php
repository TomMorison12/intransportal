<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mode;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Mode::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'city_id' => $faker->randomDigit
    ];
});
