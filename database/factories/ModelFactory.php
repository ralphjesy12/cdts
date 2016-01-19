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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Exams::class, function (Faker\Generator $faker) {

        $faker->addProvider(new Faker\Provider\en_US\Text($faker));

    return [
        'code' => strtoupper($faker->regexify('[A-Z]{10}')),
        'title' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'items' => 10,
        'attempts' => 3,
        'type' => "Verification",
        'status' => 1
    ];
});
$factory->define(App\Question::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\en_US\Text($faker));

    return [
        'body' => $faker->realText($maxNbChars = 100, $indexSize = 2),
        'choices' => json_encode($faker->realText($maxNbChars = 50, $indexSize = 2)),
    ];
});
