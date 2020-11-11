<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Artikel;
use Faker\Generator as Faker;

$factory->define(Artikel::class, function (Faker $faker) {
    return [
        'title' => $faker->lastName,
        'content' => $faker->text(200),
        'gambar' => $faker->imageUrl(600, 480),
    ];
});
