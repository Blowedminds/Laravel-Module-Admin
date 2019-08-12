<?php

use App\Modules\Core\Menu;
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

$factory->define(Menu::class, function (Faker $faker) {
    return [
        'name' => ['tr' => $faker->word],
        'url' => $faker->slug,
        'tooltip' => ['tr' => $faker->sentence],
        'weight' => $faker->randomNumber(),
        'parent' => $faker->randomNumber()
    ];
});
