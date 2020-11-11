<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Kategori;
use Faker\Generator as Faker;

$factory->define(Kategori::class, function (Faker $faker) {
    return [
        'nama' => $faker->lastName,
        'gambar' => $faker->imageUrl(640, 480)
    ];
});
