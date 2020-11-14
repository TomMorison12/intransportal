<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use App\Model;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'country_id' => function() {
            return create('App\Country')->id;
        }
    ];
});
