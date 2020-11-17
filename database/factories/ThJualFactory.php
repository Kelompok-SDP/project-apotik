<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Th_Jual;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Th_Jual::class, function (Faker $faker) {
    return [
        "id_user" => $faker->randomElement(User::all()->pluck("id")),
        "nama_dokter" => $faker->name,
        "total" => 0,
        "created_at" => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        "keterangan" => ""
    ];
});
