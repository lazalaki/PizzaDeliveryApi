<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(App\Food::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'price_eur' => $faker->numberBetween($min = 5, $max = 15),
        'description' => $faker->paragraph,
        'url' => $faker->imageUrl(640, 480),
        'type' => Arr::random(['pizza', 'burger'])
    ];
});
