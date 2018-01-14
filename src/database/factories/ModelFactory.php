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
    
    $faker->addProvider(new Faker\Provider\fr_FR\Person($faker));
    $faker->addProvider(new Faker\Provider\fr_FR\Company($faker));

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'avatar' => $faker->imageUrl(500, 500, 'animals'),
        'expertise' => $faker->jobTitle,
    ];
});

$factory->define(App\Models\Place::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\fr_FR\Address($faker));
    $faker->addProvider(new Faker\Provider\fr_FR\Company($faker));
    $location = generateRandomLocation();

    return [
        'name' => $faker->company,
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
    $faker->addProvider(new Faker\Provider\fr_FR\Company($faker));

    return [
        'name' => $faker->jobTitle,
    ];
});

function generateRandomLocation() {
    $longitude = (float) -0.556826;
    $latitude = (float) 44.825917;
    
    $rd = 25000 / 111300;
  
    $u = (float) rand() / (float) getrandmax();
    $v = (float) rand() / (float) getrandmax();
  
    $w = $rd * sqrt($u);
    $t = 2 * pi() * $v;
    $x = $w * cos($t);
    $y = $w * sin($t);
  
    $xp = $x / cos($latitude);
  
    return array('latitude' => $y + $latitude, 'longitude' => $xp + $longitude);
  }
