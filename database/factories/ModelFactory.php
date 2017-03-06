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
use Carbon\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'position_id' => $faker->numberBetween(2, 3),
        'is_admin' => false,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Candidate::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'position_id' => $faker->numberBetween(1, 2),
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'cv_file' => str_random(10).'.pdf',
        'status' => 'waiting',
    ];
});

$factory->define(App\Models\Schedule::class, function (Faker\Generator $faker) {
    return [
        'candidate_id' => $faker->numberBetween(1, 2),
        'round_id' =>$faker->numberBetween(1, 3),
        'room_id' => $faker->numberBetween(1, 2),
        'evaluation' => 'Tôt',
        'description' => 'description',
        'time' => Carbon::now(),
    ];
});

$factory->define(App\Models\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' =>$faker->text(20),
        'group_id' => $faker->numberBetween(1, 3),
    ];
});
