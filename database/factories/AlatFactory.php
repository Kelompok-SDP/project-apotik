<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Alat_Kesehatan;
use Faker\Generator as Faker;

$factory->define(Alat_Kesehatan::class, function (Faker $faker) {
    $satuan =$faker->randomElement([ 'pcs']);


    $fakers = \Faker\Factory::create();
    \Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($fakers);

    if($satuan=="pcs"){
        $kemasan = $faker->numberBetween($min = 1, $max = 10) * 10 . " " . $satuan;
    }

    return [
        'nama' => $fakers->medicine,
        'harga' => $faker->numberBetween($min = 1, $max = 100)*1000,
        'indikasi' => $faker->asciify('******* ******** ******* ********* ****** *****'),
        'stok' => $faker->numberBetween($min = 1, $max = 100),
        'satuan' => $satuan,
        'kemasan' => $kemasan,
        'deskripsi' => $faker->text($maxNbChars = 100) ,
        'manufaktur' => $faker->text($maxNbChars = 20),
        'gambar' => $faker->imageUrl(640, 480),
    ];
});
