<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Kategori;
use App\Models\Obat;
use App\Models\ObatKategori;
use Faker\Generator as Faker;

$factory->define(ObatKategori::class, function (Faker $faker) {
    return [
        "id_obats" => $faker->randomElement(Obat::all()->pluck("id")),
        "id_kategoris" => $faker->randomElement(Kategori::all()->pluck("id")),
    ];
});
