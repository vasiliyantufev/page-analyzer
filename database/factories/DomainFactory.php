<?php

$factory->define(App\Domains::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'created_at' => '2010-00-00 00:00:00',
        'updated_at' => '2010-00-00 00:00:00'
    ];
});
