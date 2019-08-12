<?php

use App\Modules\Core\Role;
use App\Modules\Core\User;
use App\Modules\Core\UserData;
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

$factory->define(UserData::class, function (Faker $faker) {
    return [
        'user_id' => static function () {
            return factory(User::class)->create()->user_id;
        },
        'role_id' => $faker->numberBetween(1, 100),
        'profile_image' => $faker->slug,
        'biography' => ['sr' => $faker->sentence]
    ];
});
