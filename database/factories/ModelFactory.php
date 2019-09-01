<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (\Faker\Generator $faker) {

    return [
        'firstname' => str_replace('.', '', $faker->unique()->firstName),
        'lastname' => str_replace('.', '', $faker->unique()->lastName),
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret',
    ];
});

$factory->define(App\Models\Product::class, function (\Faker\Generator $faker) {

    static $reduce = 999;

    return [
        'name' => $faker->word,
        'price' => $faker->randomDigit() + 10,
        'created_at' => \Carbon\Carbon::now()->subSeconds($reduce--),
    ];
});

