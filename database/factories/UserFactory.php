<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {

    return [
        'noHp' =>$faker->tollFreePhoneNumber,
        'nama' =>$faker->name,
        'email' =>$faker->freeEmail,
        'password' =>Hash::make('123'),
        "role"=>"0"
    ];
});

// select LPAD(IFNULL(max(SUBSTRING(`id`,3,3)),0)+1,3,0)from `users` where `id` like "YO%"

// bisa cuman kadang error
// $namaBaru = $faker->name;
//     $potongan = strtoupper(substr($namaBaru,0,2));
//     $hasil = DB::table('users')
//         ->select(DB::raw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex'))
//         ->where('id','LIKE',"$potongan%")
//         ->get();
//     $first = $hasil->first()->newIndex;
//     var_dump($potongan.$first);
