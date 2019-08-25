<?php

$factory->define(App\Domain::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'status' => $faker->randomNumber(),
        'header' => $faker->name,
        'body' => $faker->text,
        'h1' => $faker->name,
        'keywords' => $faker->name,
        'description' => $faker->name,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
});
