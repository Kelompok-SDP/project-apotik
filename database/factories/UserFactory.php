<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
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
        'id' => str_pad(substr($faker->name,0,1).
        User::whereRaw("id = (select max(`id`) from `users` where `id` like '".substr($faker->name,0,2)."%`)")->get(),3,'0',STR_PAD_LEFT),
        'noHp' =>$faker->tollFreePhoneNumber,
        'nama' =>$faker->name,
        'email' =>$faker->freeEmail,
        'password' =>'123',
        'status'=> 'active',

    ];
});
