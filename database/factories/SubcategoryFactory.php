<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Subcategory::class, function (Faker $faker) {
    return [
        'category_id' => 1,
        'level' => function() {
        return rand(0, 1);

    },
    'name' => $faker->word
    ];
});
