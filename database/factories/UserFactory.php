<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName(),
        'last_name' =>$faker->lastName,
        'username' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'extension_id' => function() {
            return factory('App\UserExtension')->create()->id;
        },
        'configuration_id' => function() {
            return factory('App\UserConfiguration')->create()->id;
        },
        'image_url' => $faker->imageUrl($width = 640, $height = 480),
        'means_of_id' => $faker->imageUrl($width = 640, $height = 480),
        'country' => 'Nigeria',
        'phone_number' => '08049384935',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
