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
        'email' => $faker->safeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Guest::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstNameMale,
        'last_name' => $faker->lastName,
        'official_name' => $faker->name,
        'nick_name' => $faker->firstNameMale,
        'birth_date' => $faker->date(),
        'photo_path' => '/'
    ];
});

$factory->define(App\OpenarmsSession::class, function (Faker\Generator $faker) {
    $start = $faker->dateTimeBetween('-2 years', 'now');
    return [
        'start_timestamp' => $start,
        'end_timestamp' => $faker->dateTimeBetween($start, 'now'),
        'started_by_user_id' => $faker->randomElement(range(1,UsersTableSeeder::$seedCount)),
        'ended_by_user_id' => $faker->randomElement(range(1,UsersTableSeeder::$seedCount)),
    ];
});

$factory->define(App\Attendance::class, function (Faker\Generator $faker) {
    return [
        'openarms_session_id' => random_int(1, OpenarmsSessionsTableSeeder::$seedCount),
        'signin_timestamp' => $faker->dateTimeThisMonth
    ];
});

$factory->define(App\ClothingCheckout::class, function (Faker\Generator $faker) {
    return [
        'attendance_id' => random_int(1, AttendancesTableSeeder::$seedCount),
        'checkout_timestamp' => $faker->dateTimeThisMonth,
    ];
});
