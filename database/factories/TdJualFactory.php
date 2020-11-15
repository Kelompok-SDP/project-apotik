<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Obat;
use App\Models\Td_Jual;
use Faker\Generator as Faker;

$factory->define(Td_Jual::class, function (Faker $faker) {
    $idobat = 0;
    $jumlah = 0;
    $check = null;
    do {
        $idobat = $faker->randomElement(Obat::all()->pluck("id"));
        $jumlah = $faker->numberBetween($min = 1, $max = 10);
        $check = Obat::find($idobat);
    } while ($check->stok < $jumlah);
    return [
        "tipe_produk" => "obat",
        "id_product" => $idobat,
        "jumlah" => $jumlah,
    ];
});
