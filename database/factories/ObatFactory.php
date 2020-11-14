<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Obat;
use Faker\Generator as Faker;


$factory->define(Obat::class, function (Faker $faker) {
    // misal error
    // install : composer require mbezhanov/faker-provider-collection
    $satuan =$faker->randomElement(['gr', 'ml']);


    $fakers = \Faker\Factory::create();
    \Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($fakers);

    return [
        'nama' => $fakers->medicine,
        'harga' => $faker->numberBetween($min = 1, $max = 100)*1000,
        'indikasi' => $faker->asciify('******* ******** ******* ********* ****** *****'),
        'stok' => $faker->numberBetween($min = 1, $max = 100),
        'satuan' => $satuan,
        'kemasan' => $faker->numberBetween($min = 1, $max = 10) * 10 . " " . $satuan,
        'deskripsi' => $faker->text($maxNbChars = 100)    ,
        'komposisi' => $faker->text($maxNbChars = 20),
        'dosis' => $faker->text($maxNbChars = 20),
        'segmentasi' => $faker->text($maxNbChars = 20),
        'manufaktur' => $faker->text($maxNbChars = 20),
        'gambar' => $faker->imageUrl(640, 480),
    ];
});
