<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
        'name' => $faker->name,
        'username' => str_random(6,9),
        'reset_password' => RESET_PASS,
        'email' => $faker->freeEmail,
        'password' => bcrypt('123456'), // password
    ];
});

$factory->define(Store::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'user_id' => function() {
            return factory(App\Models\User::class)->create()->id;
        },
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
