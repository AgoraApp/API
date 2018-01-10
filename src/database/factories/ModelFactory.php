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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Place::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->streetAddress,
        'zip_code' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
    ];
});

$factory->define(App\Models\Zone::class, function (Faker\Generator $faker) {
    return [
        'name' => "zone-$faker->randomLetter",
    ];
});

$factory->define(App\Models\Skill::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->jobTitle,
    ];
});
