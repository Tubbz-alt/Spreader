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

$factory->define(App\PRequestLog::class, function (Faker\Generator $faker) {
    return [
        'project_id' => 1,
        'activity_id' => rand(1, 10),
        'task_id' => rand(1, 100),
        'term_id' => rand(1, 10),
        'amigo_id' => rand(1, 10), 
        'request_udid' => md5(rand(1, 1500)),
        'requested_at' => date('Y-m-d H:i:s', time() - 30*3600*24 + rand(1, 3600*24*30))
    ];
});
