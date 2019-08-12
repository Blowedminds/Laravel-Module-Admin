<?php

use App\Modules\Admin\SiteOption;
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

$factory->define(SiteOption::class, function (Faker $faker) {
    return [
        'key' => $faker->unique()->word,
        'type' => $faker->word,
        'value' => $faker->word
    ];
});
