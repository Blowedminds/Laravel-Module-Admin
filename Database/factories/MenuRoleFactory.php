<?php

use App\Modules\Core\MenuRole;
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

$factory->define(MenuRole::class, function (Faker $faker) {
    return [
        'menu_id' => $faker->randomNumber(),
        'role_id' => $faker->randomNumber(),
    ];
});
