<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Obat;
use App\Models\Td_Jual;
use Faker\Generator as Faker;

$factory->define(Td_Jual::class, function (Faker $faker) {
    $idobat = $faker->randomElement(Obat::all()->pluck("id"));
    return [
        "tipe_produk"=>"obat",
        "id_product"=>$idobat,
        "jumlah"=>$faker->numberBetween($min = 1, $max = 10),
    ];
});
