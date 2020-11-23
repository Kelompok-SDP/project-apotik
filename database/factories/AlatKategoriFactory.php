<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\model\AlatKategori;
use App\Models\Alat_Kesehatan;
use App\Models\Kategori;
use Faker\Generator as Faker;

$factory->define(AlatKategori::class, function (Faker $faker) {
    return [
        "id_alat" => $faker->randomElement(Alat_Kesehatan::all()->pluck("id")),
        "id_kategori" => $faker->randomElement(Kategori::all()->pluck("id")),
    ];
});
