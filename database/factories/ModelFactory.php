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

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(\App\Libraries\Entities\Core\Department::class, function(Faker\Generator $faker){
    return [
        'code' => $faker->unixTime . $faker->word,
        'name' => $faker->word,
        'description' => $faker->text,
        'createdAt' => $faker->dateTimeThisYear(),
    ];
});