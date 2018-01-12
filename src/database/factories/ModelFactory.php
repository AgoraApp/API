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
    $location = getLocation();

    return [
        'name' => $faker->name,
        'address' => $faker->streetAddress,
        'zip_code' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country,
        'latitude' => $location['latitude'],
        'longitude' => $location['longitude'],
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


// Helper functions
function getLocation() {
    $longitude = (float) -0.556826;
    $latitude = (float) 44.825917;
    $radius = rand(1, 100); // in miles

    $latitude = $latitude + ($radius / 69);
    $longitude = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);

    return array('latitude' => $latitude, 'longitude' => $longitude);
}
