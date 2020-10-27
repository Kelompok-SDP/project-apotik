<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


// php artisan db:seed --database="mysql"
$factory->define(User::class, function (Faker $faker) {
    $namaBaru = $faker->name;
    $potongan = strtoupper(substr($namaBaru,0,2));
    $hasil = DB::table('users')
        ->select(DB::raw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex'))
        ->where('id','LIKE',"$potongan%")
        ->get();
    $first = $hasil->first()->newIndex;
    var_dump($potongan.$first);
    return [
        'id' => $potongan.$first,
        'noHp' =>$faker->tollFreePhoneNumber,
        'nama' =>$namaBaru,
        'email' =>$faker->freeEmail,
        'password' =>'123',        
    ];
});

// select LPAD(IFNULL(max(SUBSTRING(`id`,3,3)),0)+1,3,0)from `users` where `id` like "YO%"
